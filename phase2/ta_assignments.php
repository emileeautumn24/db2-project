<?php
/**
 * Assign a TA to a course section.
 * Expects POST: TA_id, course_id, section_id, semesterSelector, year_id
 */

// ---- Read + validate input ----
$TA_id         = $_POST["TA_id"] ?? null;
$course_id     = $_POST["course_id"] ?? null;
$section_id    = $_POST["section_id"] ?? null;
$semester_name = $_POST["semesterSelector"] ?? null;
$year_id       = $_POST["year_id"] ?? null;

if ($semester_name === null) {
    die("Please select a semester.");
}
if ($TA_id === "" || $course_id === "" || $section_id === "") {
    die("Invalid input: TA_id, course_id, and section_id are required.");
}
if (!is_numeric($year_id)) {
    die("Invalid input: year must be numeric.");
}

$year_id = (int)$year_id;

// ---- Connect ----
$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

if (!mysqli_select_db($connection, "db2")) {
    die("Could not select database.");
}

// ---- Check the section exists (all params bound, no concatenation) ----
$checkQuery = "SELECT 1 FROM section s
               WHERE s.course_id = ? AND s.section_id = ? AND s.semester = ? AND s.year = ?";
$stmt = mysqli_prepare($connection, $checkQuery);
mysqli_stmt_bind_param($stmt, "sssi", $course_id, $section_id, $semester_name, $year_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) === 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    die("Invalid course/section/semester/year combination.");
}
mysqli_stmt_close($stmt);

// ---- Check enrollment count ----
$checkEnroll = "SELECT COUNT(*) AS count FROM takes t
                WHERE t.course_id = ? AND t.section_id = ? AND t.semester = ? AND t.year = ?";
$stmt = mysqli_prepare($connection, $checkEnroll);
mysqli_stmt_bind_param($stmt, "sssi", $course_id, $section_id, $semester_name, $year_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if ((int)$row["count"] <= 10) {
    mysqli_close($connection);
    die("Section enrollment is too low (must be more than 10 students).");
}

// ---- Must be a doctoral student ----
$checkDoctoral = "SELECT student_id FROM phd WHERE student_id = ?";
$stmt = mysqli_prepare($connection, $checkDoctoral);
mysqli_stmt_bind_param($stmt, "s", $TA_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$isDoctoral = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);

if (!$isDoctoral) {
    mysqli_close($connection);
    die("Student is not a doctoral student and cannot be assigned as TA.");
}

// ---- Must not already be a TA ----
$checkAlreadyTA = "SELECT student_id FROM teacher_assistant WHERE student_id = ?";
$stmt = mysqli_prepare($connection, $checkAlreadyTA);
mysqli_stmt_bind_param($stmt, "s", $TA_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$alreadyTA = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);

if ($alreadyTA) {
    mysqli_close($connection);
    die("This student is already assigned as a TA.");
}

// ---- All checks passed: insert ----
$assignTA = "INSERT INTO teacher_assistant (student_id, course_id, section_id, semester, year)
             VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $assignTA);
mysqli_stmt_bind_param($stmt, "ssssi", $TA_id, $course_id, $section_id, $semester_name, $year_id);

if (!mysqli_stmt_execute($stmt)) {
    $err = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    die("Inserting TA failed: " . $err);
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
echo "TA successfully assigned!";
?>