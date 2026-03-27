<?php /** @noinspection SqlNoDataSourceInspection */

$TA_id = $_POST["TA_id"];
$course_id = $_POST["course_id"];
$section_id = $_POST["section_id"];
$semester_name = isset($_POST["semesterSelector"]) ? $_POST["semesterSelector"] : null;
if ($semester_name === null) {
    die("Please select a semester.");
}
$year_id = $_POST["year_id"];

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// check if input is valid
$checkQuery = "SELECT " . $course_id . ", " . $section_id . ", " . $year_id . ", '"  . $semester_name . "' FROM section s WHERE s.course_id = " . $course_id . " AND s.section_id = " . $section_id . " AND s.semester = '" . $semester_name . "' AND s.year = " . $year_id;
// if the result of the query is empty, invalid section or course id was entered
// tell user
$queryResult = mysqli_query($connection, $checkQuery) or die ('Input check failed: ' . mysqli_error($connection));
mysqli_free_result($queryResult);

// check class section size in range (10, inf)
$checkEnroll = "SELECT count(*) AS count from takes t WHERE t.course_id = " . $course_id . " AND t.section_id = " . $section_id . " AND t.semester = '" . $semester_name . "' AND t.year = " . $year_id; 
$enrollResult = mysqli_query($connection, $checkEnroll) or die ('Enrollment check failed: ' . mysqli_error($connection));
if ($row = mysqli_fetch_array($enrollResult, MYSQLI_ASSOC)) {
    if ($row["count"] > 10) {
        // check student type
        // must be doctoral student
        $checkDoctoral = "SELECT s.student_id FROM phd s WHERE s.student_id = " . $TA_id;
        $doctoralResult = mysqli_query($connection, $checkDoctoral) or die ('Student type eligibilty check failed: ' . mysqli_error($connection));
        // if not correct student type, throw error
        if (mysqli_num_rows($doctoralResult) == 0) {
            die("Error: Student is not a doctoral student and cannot be assigned as TA.");
        }
        mysqli_free_result($doctoralResult);

        // check if TA is already TA for a section
        $checkAlreadyTA = "SELECT student_id FROM teacher_assistant WHERE student_id = " . $TA_id;
        $AlreadyTAResult = mysqli_query($connection, $checkAlreadyTA) or die ('Already TA/grader eligibility check failed ' . mysqli_error($connection));
        // if TA is already TA for a section, throw error
        if (mysqli_num_rows($AlreadyTAResult) > 0) {
            die("Error: This student is already assigned as a TA.");
        }
        mysqli_free_result($AlreadyTAResult);
        
        // if we get here, all checks passed
        // insert into TA table
        $assignTA = "INSERT INTO teacher_assistant VALUES (" . $TA_id . ", " . $course_id . ", " . $section_id . ", '" . $semester_name . "', " . $year_id . ")";
        $assignTAResult = mysqli_query($connection, $assignTA) or die ('Inserting TA failed ' . mysqli_error($connection));
    } else {
        die("Error: Section enrollment is too low (must be more than 10 students).");
    }
}
mysqli_free_result($enrollResult);    

mysqli_close($connection);
?>