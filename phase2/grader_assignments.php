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

    // check class section size in range [5, 10]
    // for TA: check range [10, inf)
    $query1 = "SELECT capacity FROM section WHERE section_id = " . $section_id . " AND course_id = " . course_id;
    // if the result of the query is empty, invalid section or course id was entered
    // tell user

    // check if TA or grader is already TA/grading a section
    $query2 = "";
    // if TA/grader is already TA/grading a section
    // tell user

    // check eligibility
    // TA: must be doctoral student
    // grader: master/undergrad who got an A- or better in this course
    $query3 = "";
    // if ineligible, tell user

    // if all conditions are met, assign that ID to be a TA/grader for that course

}

mysqli_close($connection);
?>