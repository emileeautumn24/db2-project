<?php
/** @noinspection SqlNoDataSourceInspection */

$student_id         = $_POST["student_id"];
$course_id          = $_POST["course_id"];
$section_id         = $_POST["section_id"];
$semester_name      = $_POST["semesterSelector"];
$year_num           = $_POST["year_num"];
$post_text          = $_POST["post_text"];
$student_delete_id  = $_POST["student_delete_id"];
$type               = $_POST["typeSelector"];  // "STUDENT", "TA", or "GRADER"

// checks connection
$connection = mysqli_connect("localhost", "root", "")
    or die("Could not connect: " . mysqli_error($connection));

// checks if database exists
mysqli_select_db($connection, "db2") or die("Could not select database");

/**
 * Fetches the posts/replies for a given course/section/semester/year and
 * returns them as an array of ["name" => ..., "content" => ...] rows.
 * Centralizing this avoids duplicating query2/query4 from the original file.
 */
function get_discussion_posts(mysqli $connection, string $course_id, string $section_id, string $semester_name, int $year_num): array
{
    $query = "SELECT S.name, D.content
              FROM student S, discussion D, takes T
              WHERE D.course_id = ?
                AND D.section_id = ?
                AND D.semester = ?
                AND D.year = ?
                AND D.student_id = T.student_id AND D.course_id = T.course_id
                AND D.section_id = T.section_id AND D.semester = T.semester AND D.year = T.year
                AND D.student_id = S.student_id AND T.student_id = S.student_id";

    $stmt = mysqli_prepare($connection, $query) or die("Query prep failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param($stmt, "sssi", $course_id, $section_id, $semester_name, $year_num);
    mysqli_stmt_execute($stmt) or die("Query failed: " . mysqli_stmt_error($stmt));

    $result = mysqli_stmt_get_result($stmt);
    $posts = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $posts[] = $row;
    }
    mysqli_stmt_close($stmt);

    return $posts;
}

/**
 * Renders the page header (course title, section, semester/year) plus the
 * list of posts, all through htmlspecialchars() to prevent stored-XSS from
 * post content, and returns it as a single HTML string built once.
 */
function render_page(string $course_title, string $section_id, string $semester_name, int $year_num, array $posts): string
{
    $html  = "<strong>Course: </strong>" . htmlspecialchars($course_title) . "<br>";
    $html .= "<strong>Section ID: </strong>" . htmlspecialchars($section_id) . "<br>";
    $html .= "<strong>" . htmlspecialchars($semester_name) . " " . htmlspecialchars((string)$year_num) . "</strong><br>";
    $html .= "<strong><u>Discussion Board</u></strong><br><br>";

    foreach ($posts as $post) {
        $html .= "<strong>" . htmlspecialchars($post["name"]) . "</strong>: " . htmlspecialchars($post["content"]) . "<br><br>";
    }

    return $html;
}

// get course title for display
$query0 = "SELECT C.title FROM course C WHERE C.course_id = ?";
$stmt0 = mysqli_prepare($connection, $query0) or die("Query #0 prep failed: " . mysqli_error($connection));
mysqli_stmt_bind_param($stmt0, "s", $course_id);
mysqli_stmt_execute($stmt0) or die("Query #0 failed: " . mysqli_stmt_error($stmt0));
$result0 = mysqli_stmt_get_result($stmt0);

if (!($row0 = mysqli_fetch_array($result0, MYSQLI_ASSOC))) {
    die("Course ID " . htmlspecialchars($course_id) . " does not exist.");
}
$course_title = $row0["title"];
mysqli_stmt_close($stmt0);

// check if Post/Reply button or Delete button was clicked
if (isset($_POST["post_btn"])) {
    // Post/Reply was clicked

    // insert new post/reply into discussion if student is enrolled in their specific class and section
    $query1 = "INSERT INTO discussion
               SELECT ?, ?, ?, ?, ?, ?
               FROM takes T
               WHERE T.student_id = ? AND T.course_id = ? AND T.section_id = ?
                 AND T.semester = ? AND T.year = ?
                 AND NOT EXISTS (
                     SELECT 1 FROM discussion D
                     WHERE D.student_id = ? AND D.course_id = ? AND D.section_id = ?
                       AND D.semester = ? AND D.year = ?
                 )
               LIMIT 1";
    $stmt1 = mysqli_prepare($connection, $query1) or die("Query #1 prep failed: " . mysqli_error($connection));
    mysqli_stmt_bind_param(
        $stmt1,
        "ssssisssssissssi",
        $student_id, $course_id, $section_id, $semester_name, $year_num, $post_text,
        $student_id, $course_id, $section_id, $semester_name, $year_num,
        $student_id, $course_id, $section_id, $semester_name, $year_num
    );
    mysqli_stmt_execute($stmt1) or die("Query #1 failed: " . mysqli_stmt_error($stmt1));
    $was_inserted = mysqli_stmt_affected_rows($stmt1) > 0;
    mysqli_stmt_close($stmt1);

    if (!$was_inserted) {
        die("Insertion failed.");
    }

    $posts = get_discussion_posts($connection, $course_id, $section_id, $semester_name, (int)$year_num);
    echo render_page($course_title, $section_id, $semester_name, (int)$year_num, $posts);

} elseif (isset($_POST["del_btn"])) {
    // Delete was clicked

    if ($type === "TA") {
        $query3 = "DELETE D FROM discussion D
                   WHERE D.student_id = ? AND D.course_id = ? AND D.section_id = ?
                     AND D.semester = ? AND D.year = ?
                     AND EXISTS (
                         SELECT 1 FROM takes T
                         WHERE D.student_id = T.student_id AND D.course_id = T.course_id
                           AND D.section_id = T.section_id AND D.semester = T.semester AND D.year = T.year
                     )
                     AND EXISTS (
                         SELECT 1 FROM teacher_assistant TA
                         WHERE TA.student_id = ? AND D.course_id = TA.course_id AND D.section_id = TA.section_id
                           AND D.semester = TA.semester AND D.year = TA.year
                     )";
        $stmt3 = mysqli_prepare($connection, $query3) or die("Query #3 prep failed: " . mysqli_error($connection));
        mysqli_stmt_bind_param($stmt3, "ssssis", $student_delete_id, $course_id, $section_id, $semester_name, $year_num, $student_id);
    } elseif ($type === "GRADER") {
        $query3 = "DELETE D FROM discussion D
                   WHERE D.student_id = ? AND D.course_id = ? AND D.section_id = ?
                     AND D.semester = ? AND D.year = ?
                     AND EXISTS (
                         SELECT 1 FROM takes T
                         WHERE D.student_id = T.student_id AND D.course_id = T.course_id
                           AND D.section_id = T.section_id AND D.semester = T.semester AND D.year = T.year
                     )
                     AND EXISTS (
                         SELECT 1 FROM grader G
                         WHERE G.student_id = ? AND D.course_id = G.course_id AND D.section_id = G.section_id
                           AND D.semester = G.semester AND D.year = G.year
                     )";
        $stmt3 = mysqli_prepare($connection, $query3) or die("Query #3 prep failed: " . mysqli_error($connection));
        mysqli_stmt_bind_param($stmt3, "ssssis", $student_delete_id, $course_id, $section_id, $semester_name, $year_num, $student_id);
    } else {
        die("Please select either TA or Grader for deleting posts.");
    }

    mysqli_stmt_execute($stmt3) or die("Query #3 failed: " . mysqli_stmt_error($stmt3));
    $was_deleted = mysqli_stmt_affected_rows($stmt3) > 0;
    mysqli_stmt_close($stmt3);

    if (!$was_deleted) {
        die("Deletion failed.");
    }

    $posts = get_discussion_posts($connection, $course_id, $section_id, $semester_name, (int)$year_num);
    echo render_page($course_title, $section_id, $semester_name, (int)$year_num, $posts);
}

mysqli_close($connection);