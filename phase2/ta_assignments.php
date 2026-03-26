<?php /** @noinspection SqlNoDataSourceInspection */

$TA_id = $_POST["TA_id"];
$course_id = $_POST["course_id"];
$section_id = $_POST["section_id"];
$semester_name = $_POST["semesterSelector"];
$year_id = $_POST["year_id"];

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// check if assign button was clicked
if (isset($_POST["submit"])) {
    // Submit Button was clicked
    // check if input is valid
    $checkQuery = "SELECT " . $course_id . ", " . $section_id . ", " . $year_id . ", "  . $semester_name . ", FROM section s WHERE s.course_id = " . $course_id . " AND s.section_id = " . $section_id . " AND s.semester = " . $semester_name . " AND s.year = " . $year_id;
    // if the result of the query is empty, invalid section or course id was entered
    // tell user
    $queryResult = mysqli_query($connection, $checkQuery) or die ('Input check failed: ' . mysqli_error($connection));
    mysqli_free_result($queryResult);

    // check class section size in range (10, inf)
    $checkEnroll = "SELECT count(*) AS count from takes t WHERE t.course_id = " . $course_id . " AND t.section_id = " . $section_id . " AND t.semester " . $semester_name . " AND t.year = " . $year_id; 
    $enrollResult = mysqli_query($connection, $checkEnroll) or die ('Enrollment check failed: ' . mysqli_error($connection));
    if ($row = mysqli_fetch_array($enrollResult, MYSQLI_ASSOC)) {
        if ($row["count"] > 10) {
            // check student type
            // must be doctoral student
            $checkDoctoral = "SELECT s.student_id FROM phd s WHERE s.student_id = " . $TA_id;
            // if not correct student type, throw error
            $doctoralResult = mysqli_query($connection, $checkDoctoral) or die ('Student type eligibilty check failed: ' . mysqli_error($connection));
            mysqli_free_result($doctoralResult);

            // check if TA is already TA for a section
            $checkAlreadyTA = "SELECT student_id FROM teacher_assistant WHERE student_id = " . $TA_id;
            // if TA is already TA for a section, throw error
            $AlreadyTAResult = mysqli_query($connection, $AlreadyTAResult) or die ('Already TA/grader eligibility check failed ' . mysqli_error($connection));
            mysqli_free_result($AlreadyTAResult)
            
            // if we get here, all checks passed
            // insert into TA table
            $assignTA = "INSERT INTO teacher_assistant VALUES (" . $TA_id . ", " . $course_id . ", " . $section_id . ", " . $semester_name . ", " . $year_id . ")";
        }
    }
    mysqli_free_result($enrollResult);    
}

mysqli_close($connection);
?>