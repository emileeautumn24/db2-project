<?php /** @noinspection SqlNoDataSourceInspection */

$instructor_id = $_POST['instructor_id'];
$student_id = $_POST['student_id'];
$type = $_POST['typeSelector'];  // Gets "UNDERGRAD", "MS", or "PHD"

// checks connection
$connection = mysqli_connect('localhost', 'root', '')
or die ('Could not connect: ' . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, 'db2') or die ('Could not select database');

// get student and instructor names for display
$query0 = 'SELECT I.name AS i_name, S.name AS s_name FROM advising A, instructor I, student S WHERE A.instructor_id = ' . $instructor_id . ' AND A.student_id = ' . $student_id . ' AND A.instructor_id = I.instructor_id AND A.student_id = S.student_id';
$result0 = mysqli_query($connection, $query0) or die ('Query #0 failed: ' . mysqli_error($connection));

if ($row = mysqli_fetch_array($result0, MYSQLI_ASSOC)) {
    echo '<strong>Instructor ID: </strong>' . $instructor_id . '<br>';
    echo '<strong>Instructor Name: </strong>' . $row["i_name"] . '<br><br>';
    echo '<strong>Student ID: </strong>' . $student_id . '<br>';
    echo '<strong>Student Name: </strong>' . $row["s_name"] . '<br><br>';
} else {
    die ('Instructor ID ' . $instructor_id . ' may not have Student ID ' . $student_id. ' as their advisee.');
}

mysqli_free_result($result0);

// gets list of courses the student had taken
$query1 = 'SELECT C.title FROM course C, takes T, advising A WHERE A.instructor_id = ' . $instructor_id . ' AND A.student_id = ' . $student_id . ' AND A.student_id = T.student_id AND T.course_id = C.course_id';
$result1 = mysqli_query($connection, $query1) or die ('Query #1 failed: ' . mysqli_error($connection));

echo '<strong><u>Courses Taken</u></strong><br>';

while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    echo $row["title"];
    echo '<br>';
}
echo '<br>';

mysqli_free_result($result1);

// gets grades of courses the student had taken
$cumulative_gpa = 0.0;
$taken_courses = 0.0;

$query2 = 'SELECT T.grade, C.credits FROM takes T, advising A, course C WHERE A.instructor_id = ' . $instructor_id . ' AND A.student_id = ' . $student_id . ' AND A.student_id = T.student_id AND T.course_id = C.course_id';
$result2 = mysqli_query($connection, $query2) or die ('Query #2 failed: ' . mysqli_error($connection));

echo '<strong><u>Cumulative GPA</u></strong><br>';

// calculate GPA
while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    switch ($row["grade"]) {
        case 'A':
            $cumulative_gpa = $cumulative_gpa + (4.0 * $row["credits"]);
            break;
        case 'A-':
            $cumulative_gpa = $cumulative_gpa + (3.7 * $row["credits"]);
            break;
        case 'B+':
            $cumulative_gpa = $cumulative_gpa + (3.3 * $row["credits"]);
            break;
        case 'B':
            $cumulative_gpa = $cumulative_gpa + (3.0 * $row["credits"]);
            break;
        case 'B-':
            $cumulative_gpa = $cumulative_gpa + (2.7 * $row["credits"]);
            break;
        case 'C+':
            $cumulative_gpa = $cumulative_gpa + (2.3 * $row["credits"]);
            break;
        case 'C':
            $cumulative_gpa = $cumulative_gpa + (2.0 * $row["credits"]);
            break;
        case 'C-':
            $cumulative_gpa = $cumulative_gpa + (1.7 * $row["credits"]);
            break;
        case 'D+':
            $cumulative_gpa = $cumulative_gpa + (1.3 * $row["credits"]);
            break;
        case 'D':
            $cumulative_gpa = $cumulative_gpa + (1.0 * $row["credits"]);
            break;
        default:
        $cumulative_gpa = 0.0;
    }
    $taken_courses = $taken_courses + (4.0 * $row["credits"]);
}

if ($taken_courses > 0.0) {
    $cumulative_gpa /= $taken_courses;
    $cumulative_gpa *= 4.0;
}

echo $cumulative_gpa;
echo '<br><br>';

mysqli_free_result($result2);

// calculate remaining credits to graduate depending on student type
$remaining_credits = 0;
if ($type === 'UNDERGRAD') {
    $query3 = 'SELECT S.total_credit FROM advising A, student S, undergraduate U WHERE A.instructor_id = ' . $instructor_id . ' AND A.student_id = ' . $student_id . ' AND A.student_id = S.student_id AND A.student_id = U.student_id AND S.student_id = U.student_id';
    $result3 = mysqli_query($connection, $query3) or die ('Query #3 failed: ' . mysqli_error($connection));
    if ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
        $remaining_credits = 120 - $row["total_credit"];
    } else {
        die ('Student ID ' . $student_id. ' is not an undergrad.');
    }
} elseif ($type === 'MS') {
    $query3 = 'SELECT S.total_credit FROM advising A, student S, master M WHERE A.instructor_id = ' . $instructor_id . ' AND A.student_id = ' . $student_id . ' AND A.student_id = S.student_id AND A.student_id = M.student_id AND S.student_id = M.student_id';
    $result3 = mysqli_query($connection, $query3) or die ('Query #3 failed: ' . mysqli_error($connection));
    if ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
        $remaining_credits = 30 - $row["total_credit"];
    } else {
        die ('Student ID ' . $student_id. ' is not an MS.');
    }
} elseif ($type === 'PHD') {
    $query3 = 'SELECT S.total_credit FROM advising A, student S, phd P WHERE A.instructor_id = ' . $instructor_id . ' AND A.student_id = ' . $student_id . ' AND A.student_id = S.student_id AND A.student_id = P.student_id AND S.student_id = P.student_id';
    $result3 = mysqli_query($connection, $query3) or die ('Query #3 failed: ' . mysqli_error($connection));
    if ($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
        $remaining_credits = 42 - $row["total_credit"];
    } else {
        die ('Student ID ' . $student_id. ' is not a PhD.');
    }
} else {
    die('Please select a student type.');
}

echo '<strong><u>Remaining Credits to Graduate</u></strong><br>';
if ($remaining_credits < 0) {
    $remaining_credits = 0;
}
echo $remaining_credits;

mysqli_free_result($result3);
mysqli_close($connection);

?>