<?php /** @noinspection SqlNoDataSourceInspection */

$student_id    = $_POST["student_id"];
$course_id     = $_POST["course_id"];
$section_id    = $_POST["section_id"];
$semester_name = isset($_POST["semesterSelector"]) ? $_POST["semesterSelector"] : null;
if ($semester_name === null) {
    die("Please select a semester.");
}
$year_id = (int) $_POST["year_id"];

// checks connection
$connection = mysqli_connect("localhost", "root", "")
    or die("Could not connect: " . mysqli_connect_error());

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die("Could not select database");

// check if View button or Enroll button is clicked
if (isset($_POST["view_btn"])) {
    view_offerings($connection, $semester_name, $year_id);
} elseif (isset($_POST["enroll_btn"])) {
    enroll_student($connection, $student_id, $course_id, $section_id, $semester_name, $year_id);
}

mysqli_close($connection);

/**
 * Displays the list of course offerings for a given semester/year.
 */
function view_offerings(mysqli $connection, string $semester_name, int $year_id): void
{
    $query = "SELECT C.course_id, C.title, C.dept_name, C.credits, S.section_id
              FROM course C, section S
              WHERE S.semester = ? AND S.year = ? AND C.course_id = S.course_id";

    $stmt = mysqli_prepare($connection, $query)
        or die("View courses failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param($stmt, "si", $semester_name, $year_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $rows_html = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $rows_html .= render_offering_row($row);
    }
    mysqli_stmt_close($stmt);

    echo <<<HTML
        <strong>{$semester_name} {$year_id} Course Offerings</strong><br><br>
        {$rows_html}
        HTML;
}

/**
 * Builds the HTML block for a single course/section row.
 * Values are HTML-escaped since they come from the database (which could
 * itself contain user-supplied data from other parts of the app).
 */
function render_offering_row(array $row): string
{
    $title    = htmlspecialchars($row["title"]);
    $courseId = htmlspecialchars($row["course_id"]);
    $sectionId = htmlspecialchars($row["section_id"]);
    $dept     = htmlspecialchars($row["dept_name"]);
    $credits  = htmlspecialchars($row["credits"]);

    return <<<HTML
        <strong>{$title}</strong><br>
        <strong>Course ID: </strong>{$courseId}<br>
        <strong>Section ID: </strong>{$sectionId}<br>
        <strong>Department: </strong>{$dept}<br>
        <strong>Credits: </strong>{$credits}<br><br>
        HTML;
}

/**
 * Handles the enroll button: validates the section, capacity, prior
 * completion, and prerequisites, then inserts the enrollment.
 */
function enroll_student(
    mysqli $connection,
    string $student_id,
    string $course_id,
    string $section_id,
    string $semester_name,
    int $year_id
): void {
    // Check if course and section exist
    $query1 = "SELECT course_id, section_id, semester, year
               FROM section
               WHERE course_id = ? AND section_id = ? AND semester = ? AND year = ?";
    $stmt1 = mysqli_prepare($connection, $query1)
        or die("Course and/or Section doesn't exist: " . mysqli_error($connection));
    mysqli_stmt_bind_param($stmt1, "sssi", $course_id, $section_id, $semester_name, $year_id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);

    if (!mysqli_fetch_assoc($result1)) {
        mysqli_stmt_close($stmt1);
        die("Course and/or Section doesn't exist.");
    }
    mysqli_stmt_close($stmt1);

    // Check if section is full
    $query2 = "SELECT
                   (SELECT count(*) FROM takes T
                    WHERE T.course_id = ? AND T.section_id = ? AND T.semester = ? AND T.year = ?) AS count,
                   S.capacity
               FROM section S
               WHERE S.course_id = ? AND S.section_id = ? AND S.semester = ? AND S.year = ?";
    $stmt2 = mysqli_prepare($connection, $query2)
        or die("Course and/or Section count failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param(
        $stmt2,
        "sssisssi",
        $course_id, $section_id, $semester_name, $year_id,
        $course_id, $section_id, $semester_name, $year_id
    );
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $countRow = mysqli_fetch_assoc($result2);
    mysqli_stmt_close($stmt2);

    if (!$countRow) {
        die("Course and/or Section count failed.");
    }
    if ($countRow["count"] >= $countRow["capacity"]) {
        die("Section is full.");
    }

    // Check if student already passed the course
    $query6 = "SELECT student_id, course_id FROM takes
               WHERE student_id = ? AND course_id = ? AND grade <> 'F'";
    $stmt6 = mysqli_prepare($connection, $query6)
        or die("Course taken check failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param($stmt6, "ss", $student_id, $course_id);
    mysqli_stmt_execute($stmt6);
    mysqli_stmt_store_result($stmt6);
    if (mysqli_stmt_num_rows($stmt6) > 0) {
        mysqli_stmt_close($stmt6);
        die("Student already passed the course.");
    }
    mysqli_stmt_close($stmt6);

    // Check prerequisites
    $query3 = "SELECT count(*) AS count FROM prereq WHERE course_id = ?";
    $stmt3 = mysqli_prepare($connection, $query3)
        or die("Prereq count failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param($stmt3, "s", $course_id);
    mysqli_stmt_execute($stmt3);
    $result3 = mysqli_stmt_get_result($stmt3);
    $countRow1 = mysqli_fetch_assoc($result3);
    mysqli_stmt_close($stmt3);

    if ($countRow1 && $countRow1["count"] > 0) {
        $query4 = "SELECT prereq_id FROM prereq WHERE course_id = ?";
        $stmt4 = mysqli_prepare($connection, $query4)
            or die("Selecting prereq IDs failed: " . mysqli_error($connection));
        mysqli_stmt_bind_param($stmt4, "s", $course_id);
        mysqli_stmt_execute($stmt4);
        $result4 = mysqli_stmt_get_result($stmt4);

        $query5 = "SELECT course_id FROM takes WHERE course_id = ? AND student_id = ?";
        $stmt5 = mysqli_prepare($connection, $query5)
            or die("Finding prereq ID failed: " . mysqli_error($connection));

        while ($prereqRow = mysqli_fetch_assoc($result4)) {
            $prereq_id = $prereqRow["prereq_id"];
            mysqli_stmt_bind_param($stmt5, "ss", $prereq_id, $student_id);
            mysqli_stmt_execute($stmt5);
            mysqli_stmt_store_result($stmt5);
            if (mysqli_stmt_num_rows($stmt5) <= 0) {
                mysqli_stmt_close($stmt5);
                mysqli_stmt_close($stmt4);
                die("Student has not completed the prerequisites yet.");
            }
        }
        mysqli_stmt_close($stmt5);
        mysqli_stmt_close($stmt4);
    }

    insert_enrollment($connection, $student_id, $course_id, $section_id, $semester_name, $year_id);
    echo "Student successfully enrolled!";
}

/**
 * Inserts a new row into `takes` for the given student/course/section.
 */
function insert_enrollment(
    mysqli $connection,
    string $student_id,
    string $course_id,
    string $section_id,
    string $semester_name,
    int $year_id
): void {
    $query = "INSERT INTO takes VALUES (?, ?, ?, ?, ?, NULL)";
    $stmt = mysqli_prepare($connection, $query)
        or die("Enroll student failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param($stmt, "ssssi", $student_id, $course_id, $section_id, $semester_name, $year_id);
    mysqli_stmt_execute($stmt)
        or die("Enroll student failed: " . mysqli_error($connection));
    mysqli_stmt_close($stmt);
}
