<?php /** @noinspection SqlNoDataSourceInspection */

$grader_id = $_POST["grader_id"];
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

// check class section size in range [5, 10]
$checkEnroll = "SELECT count(*) AS count from takes t WHERE t.course_id = " . $course_id . " AND t.section_id = " . $section_id . " AND t.semester = '" . $semester_name . "' AND t.year = " . $year_id; 
$enrollResult = mysqli_query($connection, $checkEnroll) or die ('Enrollment check failed: ' . mysqli_error($connection));
if ($row = mysqli_fetch_array($enrollResult, MYSQLI_ASSOC)) {
    if ($row["count"] >= 5 && $row["count"] <= 10) {
        // check student type
        // master/undergrad
        $checkMasterUndergrad = "SELECT student_id FROM master WHERE student_id = " . $grader_id . " UNION SELECT student_id FROM undergraduate WHERE student_id = " . $grader_id;
        // if not correct student type, throw error
        $masterUndergradResult = mysqli_query($connection, $checkMasterUndergrad) or die ('Student type eligibilty check failed: ' . mysqli_error($connection));
        if (mysqli_num_rows($masterUndergradResult) == 0) {
            die("Error: Student is not an undergrad or masters student and cannot be assigned as a grader.");
        }
        mysqli_free_result($masterUndergradResult);

        // check if got an A- or better in this course
        $checkEligibleGrade = "SELECT grade AS g FROM takes t WHERE t.student_id = " . $grader_id . " AND t.course_id = " . $course_id;
        $eligibleGradeResult = mysqli_query($connection, $checkEligibleGrade) or die ('Grade eligibility check failed: ' . mysqli_error($connection));
        $gradeRow = mysqli_fetch_array($eligibleGradeResult, MYSQLI_ASSOC);
        if ($gradeRow && ($gradeRow["g"] == 'A' || $gradeRow["g"] == 'A-')) {
            // check if grader is already grader/grading a section
            $checkAlreadyGrader = "SELECT student_id FROM grader WHERE student_id = " . $grader_id;
            // if grader is already grading a section, throw error
            $AlreadyGraderResult = mysqli_query($connection, $checkAlreadyGrader) or die ('Already grader eligibility check failed ' . mysqli_error($connection));
            if (mysqli_num_rows($AlreadyGraderResult) > 0) {
                die("Error: This student is already assigned as a grader.");
            }
            mysqli_free_result($AlreadyGraderResult);
            
            // if we get here, all checks passed
            // insert into grader table
            $assignGrader = "INSERT INTO grader VALUES (" . $grader_id . ", " . $course_id . ", " . $section_id . ", '" . $semester_name . "', " . $year_id . ")";
            $assignGraderResult = mysqli_query($connection, $assignGrader) or die ('Inserting grader failed ' . mysqli_error($connection));
            echo "Grader successfully assigned!";
        } else {
            die("Error: Student has grade B+ or below and cannot be assigned as a grader.");
        }
        mysqli_free_result($eligibleGradeResult);
    } else {
        die("Error: Section enrollment is too low (must be between 5 and 10 students).");
    }
}
mysqli_free_result($enrollResult);

mysqli_close($connection);
?>