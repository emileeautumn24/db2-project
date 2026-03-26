<?php /** @noinspection SqlNoDataSourceInspection */

$grader_id = $_POST["grader_id"];
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

    // check class section size in range [5, 10]
    $checkEnroll = "SELECT count(*) AS count from takes t WHERE t.course_id = " . $course_id . " AND t.section_id = " . $section_id . " AND t.semester " . $semester_name . " AND t.year = " . $year_id; 
    $enrollResult = mysqli_query($connection, $checkEnroll) or die ('Enrollment check failed: ' . mysqli_error($connection));
    if ($row = mysqli_fetch_array($enrollResult, MYSQLI_ASSOC)) {
        if ($row["count"] >= 5 && $row["count"] <= 10) {
            // check student type
            // master/undergrad
            $checkMasterUndergrad = "SELECT student_id AS id FROM master m, undergraduate s WHERE m.student_id = s.student_id" . $grader_id;
            // if not correct student type, throw error
            $masterUndergradResult = mysqli_query($connection, $checkMasterUndergrad) or die ('Student type eligibilty check failed: ' . mysqli_error($connection));
            mysqli_free_result($masterUndergradResult);

            // check if got an A- or better in this course
            $checkEligibleGrade = "SELECT grade AS g FROM takes t WHERE t.student_id = " . $grader_id . "AND t.course_id = " . $course_id;
            $eligibleGradeResult = mysqli_query($connection, $checkEligibleGrade) or die ('Grade eligibility check failed: ' . mysqli_error($connection));
            if ($row["g"] == 'A' || $row["g"] == 'A-') {
                // check if grader is already grader/grading a section
                $checkAlreadyGrader = "SELECT student_id FROM grader WHERE student_id = " . $grader_id;
                // if grader is already grading a section, throw error
                $AlreadyGraderResult = mysqli_query($connection, $AlreadyGraderResult) or die ('Already grader eligibility check failed ' . mysqli_error($connection));
                mysqli_free_result($AlreadyGraderResult)
                
                // if we get here, all checks passed
                // insert into grader table
                $assignGrader = "INSERT INTO grader VALUES (" . $grader_id . ", " . $course_id . ", " . $section_id . ", " . $semester_name . ", " . $year_id . ")";
                }
            mysqli_free_result($eligibleGradeResult);

        }
    }
    mysqli_free_result($enrollResult);    
}

mysqli_close($connection);
?>