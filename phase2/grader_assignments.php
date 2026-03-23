<?php /** @noinspection SqlNoDataSourceInspection */

$grader_id = $_POST["grader_id"];
$course_id = $_POST["course_id"];
$section_id = $_POST["section_id"];
$semester_name = $_POST["semester_name"];
$year_num = $_POST["year_num"];
$post_text = $_POST["post_text"];
$student_delete_id = $_POST["student_delete_id"];
$type = $_POST["typeSelector"];  // Gets "STUDENT", "TA" or "GRADER"

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

mysqli_close($connection);
?>