<?php
/**
 * Assign a grader to a course section.
 * Expects POST: grader_id, course_id, section_id, semesterSelector, year_id
 */

// ---- Read + validate input ----
$grader_id     = $_POST["grader_id"] ?? null;
$course_id     = $_POST["course_id"] ?? null;
$section_id    = $_POST["section_id"] ?? null;
$semester_name = $_POST["semesterSelector"] ?? null;
$year_id       = $_POST["year_id"] ?? null;

if ($semester_name === null) {
    die("Please select a semester.");
}
if ($grader_id === "" || $course_id === "" || $section_id === "") {
    die("Invalid input: grader_id, course_id, and section_id are required.");
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

// ---- Check enrollment count is in [5, 10] ----
$checkEnroll = "SELECT COUNT(*) AS count FROM takes t
                WHERE t.course_id = ? AND t.section_id = ? AND t.semester = ? AND t.year = ?";
$stmt = mysqli_prepare($connection, $checkEnroll);
mysqli_stmt_bind_param($stmt, "sssi", $course_id, $section_id, $semester_name, $year_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

$count = (int)$row["count"];
if ($count < 5 || $count > 10) {
    mysqli_close($connection);
    die("Section enrollment is too low (must be between 5 and 10 students).");
}

// ---- Must be a master's or undergraduate student ----
$checkMasterUndergrad = "SELECT student_id FROM master WHERE student_id = ?
                          UNION
                          SELECT student_id FROM undergraduate WHERE student_id = ?";
$stmt = mysqli_prepare($connection, $checkMasterUndergrad);
mysqli_stmt_bind_param($stmt, "ss", $grader_id, $grader_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$isMasterUndergrad = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);

if (!$isMasterUndergrad) {
    mysqli_close($connection);
    die("Student is not an undergrad or masters student and cannot be assigned as a grader.");
}

// ---- Must have earned an A- or better in this course ----
$checkEligibleGrade = "SELECT grade AS g FROM takes t WHERE t.student_id = ? AND t.course_id = ?";
$stmt = mysqli_prepare($connection, $checkEligibleGrade);
mysqli_stmt_bind_param($stmt, "ss", $grader_id, $course_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$gradeRow = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$gradeRow || ($gradeRow["g"] !== 'A' && $gradeRow["g"] !== 'A-')) {
    mysqli_close($connection);
    die("Student has grade B+ or below and cannot be assigned as a grader.");
}

// ---- Must not already be a grader ----
$checkAlreadyGrader = "SELECT student_id FROM grader WHERE student_id = ?";
$stmt = mysqli_prepare($connection, $checkAlreadyGrader);
mysqli_stmt_bind_param($stmt, "s", $grader_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$alreadyGrader = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);

if ($alreadyGrader) {
    mysqli_close($connection);
    die("This student is already assigned as a grader.");
}

// ---- All checks passed: insert ----
$assignGrader = "INSERT INTO grader (student_id, course_id, section_id, semester, year)
                  VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $assignGrader);
mysqli_stmt_bind_param($stmt, "ssssi", $grader_id, $course_id, $section_id, $semester_name, $year_id);

if (!mysqli_stmt_execute($stmt)) {
    $err = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    die("Inserting grader failed: " . $err);
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
echo "Grader successfully assigned!";
?>