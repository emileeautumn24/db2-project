<?php /** @noinspection SqlNoDataSourceInspection */

require_once 'calculate_gpa.php';

$student_id = $_POST['student_id'];

// checks connection
$connection = mysqli_connect('localhost', 'root', '')
    or die('Could not connect: ' . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, 'db2') or die('Could not select database');

// --- get student name -------------------------------------------------
$stmt0 = mysqli_prepare($connection, 'SELECT S.name AS s_name FROM student S WHERE S.student_id = ?');
mysqli_stmt_bind_param($stmt0, 's', $student_id);
mysqli_stmt_execute($stmt0);
$result0 = mysqli_stmt_get_result($stmt0);

if (!($row = mysqli_fetch_array($result0, MYSQLI_ASSOC))) {
    die('Student ID ' . htmlspecialchars($student_id) . ' does not exist.');
}
$student_name = $row['s_name'];
mysqli_stmt_close($stmt0);

// --- get list of courses the student had taken -------------------------
$stmt1 = mysqli_prepare(
    $connection,
    'SELECT C.title FROM course C, takes T, student S
     WHERE S.student_id = ? AND S.student_id = T.student_id AND T.course_id = C.course_id'
);
mysqli_stmt_bind_param($stmt1, 's', $student_id);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);

$courses = [];
while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $courses[] = $row['title'];
}
mysqli_stmt_close($stmt1);

// --- get grades of courses taken, calculate GPA -------------------------
$stmt2 = mysqli_prepare(
    $connection,
    'SELECT T.grade, C.credits FROM takes T, student S, course C
     WHERE S.student_id = ? AND S.student_id = T.student_id AND T.course_id = C.course_id'
);
mysqli_stmt_bind_param($stmt2, 's', $student_id);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

$cumulative_gpa = calculate_gpa($connection, $result2);
mysqli_stmt_close($stmt2);

// --- get total credits earned -------------------------------------------
$stmt3 = mysqli_prepare($connection, 'SELECT S.total_credit FROM student S WHERE S.student_id = ?');
mysqli_stmt_bind_param($stmt3, 's', $student_id);
mysqli_stmt_execute($stmt3);
$result3 = mysqli_stmt_get_result($stmt3);

$credits_earned = 0;
if ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    $credits_earned = $row['total_credit'];
}
mysqli_stmt_close($stmt3);

mysqli_close($connection);

// --- render ---------------------------------------------------------------
// All data is gathered above; the HTML is built once and echoed a single
// time, instead of interleaving echo calls with the query logic.
$courses_html = $courses
    ? implode('<br>', array_map('htmlspecialchars', $courses))
    : '<em>No courses on record.</em>';
?>
<strong>Student ID: </strong><?= htmlspecialchars($student_id) ?><br>
<strong>Student Name: </strong><?= htmlspecialchars($student_name) ?><br><br>

<strong><u>Courses Taken</u></strong><br>
<?= $courses_html ?>
<br><br>

<strong><u>Cumulative GPA</u></strong><br>
<?= htmlspecialchars($cumulative_gpa) ?><br><br>

<strong><u>Total Credits Earned</u></strong><br>
<?= htmlspecialchars($credits_earned) ?>