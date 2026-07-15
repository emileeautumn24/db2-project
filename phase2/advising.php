<?php /** @noinspection SqlNoDataSourceInspection */

require_once 'calculate_gpa.php';

$instructor_id = $_POST['instructor_id'];
$student_id = $_POST['student_id'];
$type = $_POST['typeSelector'];  // Gets "UNDERGRAD", "MS", or "PHD"

$connection = mysqli_connect('localhost', 'root', '')
    or die('Could not connect: ' . mysqli_error($connection));

mysqli_select_db($connection, 'db2') or die('Could not select database');

// --- Get student and instructor names ---
$stmt = mysqli_prepare($connection,
    'SELECT I.name AS i_name, S.name AS s_name
       FROM advising A, instructor I, student S
      WHERE A.instructor_id = ? AND A.student_id = ?
        AND A.instructor_id = I.instructor_id AND A.student_id = S.student_id');
mysqli_stmt_bind_param($stmt, 'ss', $instructor_id, $student_id);
mysqli_stmt_execute($stmt);
$result0 = mysqli_stmt_get_result($stmt);
$names = mysqli_fetch_assoc($result0);
mysqli_stmt_close($stmt);

if (!$names) {
    die("Instructor ID $instructor_id may not have Student ID $student_id as their advisee.");
}
?>

<strong>Instructor ID: </strong><?= htmlspecialchars($instructor_id) ?><br>
<strong>Instructor Name: </strong><?= htmlspecialchars($names['i_name']) ?><br><br>
<strong>Student ID: </strong><?= htmlspecialchars($student_id) ?><br>
<strong>Student Name: </strong><?= htmlspecialchars($names['s_name']) ?><br><br>

<?php
// --- Get list of courses taken ---
$stmt = mysqli_prepare($connection,
    'SELECT C.title
       FROM course C, takes T, advising A
      WHERE A.instructor_id = ? AND A.student_id = ?
        AND A.student_id = T.student_id AND T.course_id = C.course_id');
mysqli_stmt_bind_param($stmt, 'ss', $instructor_id, $student_id);
mysqli_stmt_execute($stmt);
$result1 = mysqli_stmt_get_result($stmt);
$courses = mysqli_fetch_all($result1, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
?>

<strong><u>Courses Taken</u></strong><br>
<?php foreach ($courses as $course): ?>
    <?= htmlspecialchars($course['title']) ?><br>
<?php endforeach; ?>
<br>

<?php
// --- Get grades and calculate GPA ---
$stmt = mysqli_prepare($connection,
    'SELECT T.grade, C.credits
       FROM takes T, advising A, course C
      WHERE A.instructor_id = ? AND A.student_id = ?
        AND A.student_id = T.student_id AND T.course_id = C.course_id');
mysqli_stmt_bind_param($stmt, 'ss', $instructor_id, $student_id);
mysqli_stmt_execute($stmt);
$result2 = mysqli_stmt_get_result($stmt);
$cumulative_gpa = calculate_gpa($connection, $result2);
mysqli_stmt_close($stmt);
?>

<strong><u>Cumulative GPA</u></strong><br>
<?= $cumulative_gpa ?><br><br>

<?php
// --- Calculate remaining credits to graduate depending on student type ---
$credit_requirements = [
    'UNDERGRAD' => ['table' => 'undergraduate', 'required' => 120, 'label' => 'undergrad'],
    'MS'        => ['table' => 'master',        'required' => 30,  'label' => 'MS'],
    'PHD'       => ['table' => 'phd',           'required' => 42,  'label' => 'PhD'],
];

if (!isset($credit_requirements[$type])) {
    die('Please select a student type.');
}

$config = $credit_requirements[$type];

// Table name comes from our own fixed array above, never from user input,
// so it's safe to interpolate here — it can never be attacker-controlled.
$stmt = mysqli_prepare($connection,
    "SELECT S.total_credit
       FROM advising A, student S, {$config['table']} X
      WHERE A.instructor_id = ? AND A.student_id = ?
        AND A.student_id = S.student_id AND A.student_id = X.student_id
        AND S.student_id = X.student_id");
mysqli_stmt_bind_param($stmt, 'ss', $instructor_id, $student_id);
mysqli_stmt_execute($stmt);
$result3 = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result3);
mysqli_stmt_close($stmt);

if (!$row) {
    die("Student ID $student_id is not a {$config['label']}.");
}

$remaining_credits = max(0, $config['required'] - $row['total_credit']);
?>

<strong><u>Remaining Credits to Graduate</u></strong><br>
<?= $remaining_credits ?>

<?php mysqli_close($connection); ?>