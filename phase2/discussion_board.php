<?php /** @noinspection SqlNoDataSourceInspection */

$student_id = $_POST["student_id"];
$course_id = $_POST["course_id"];
$section_id = $_POST["section_id"];
$semester_name = $_POST["semesterSelector"];
$year_num = $_POST["year_num"];
$post_text = $_POST["post_text"];
$student_delete_id = $_POST["student_delete_id"];
$type = $_POST["typeSelector"];  // Gets "STUDENT", "TA" or "GRADER"

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// display Course and Section Discussion Board

// get course name for display
$query0 = "SELECT C.title FROM course C WHERE C.course_id = " . $course_id;
$result0 = mysqli_query($connection, $query0) or die ("Query #0 failed: " . mysqli_error($connection));
if ($row = mysqli_fetch_array($result0, MYSQLI_ASSOC)) {
    echo "<strong>Course: </strong>" . $row["title"] . "<br>";
} else {
    die ("Course ID " . $course_id . " does not exist.");
}
echo "<strong>Section ID: </strong>" . $section_id . "<br>";
echo "<strong>" . $semester_name . " " . $year_num . "</strong><br>";
echo "<strong><u>Discussion Board</u></strong><br><br>";

// check if Post/Reply button or Delete button was clicked
if (isset($_POST["post_btn"])) {
    // Post/Reply was clicked

    // Escape post_text to safely handle apostrophes and special characters
    $safe_post_text = mysqli_real_escape_string($connection, $post_text);

    // insert new post/reply into discussion if student is enrolled in their specific class and section
    $query1 = "INSERT INTO discussion SELECT " . $student_id . ", " . $course_id . ", " . $section_id .
    ", '" . $semester_name . "', " . $year_num . ", '" . $safe_post_text . "' FROM takes T WHERE T.student_id = " . $student_id .
    " AND T.course_id = " . $course_id . " AND T.section_id = " . $section_id . " AND T.semester = '" . $semester_name .
    "' AND T.year = " . $year_num . " AND NOT EXISTS ( SELECT 1 FROM discussion D WHERE D.student_id = " .
    $student_id . " AND D.course_id = " . $course_id . " AND D.section_id = " . $section_id ." AND D.semester = '" .
    $semester_name . "' AND D.year = " . $year_num . " ) LIMIT 1";
    $result1 = mysqli_query($connection, $query1) or die ("Query #1 failed: " . mysqli_error($connection));
    $was_inserted = mysqli_affected_rows($connection) > 0;
    if (!$was_inserted) {
        die ("Insertion failed.");
    }

    // display posts/replies from discussion after inserting new post/reply
    $query2 = "SELECT S.name, D.content FROM student S, discussion D, takes T WHERE D.course_id = " . $course_id .
    " AND D.section_id = " . $section_id . " AND D.semester = '" . $semester_name . "' AND D.year = " . $year_num .
    " AND D.student_id = T.student_id AND D.course_id = T.course_id AND D.section_id = T.section_id AND" .
    " D.semester = T.semester AND D.year = T.year AND D.student_id = S.student_id AND T.student_id = S.student_id";
    $result2 = mysqli_query($connection, $query2) or die ("Query #2 failed: " . mysqli_error($connection));
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        echo "<strong>" . $row["name"] . "</strong>: " . $row["content"] . "<br><br>";
    }
    mysqli_free_result($result2);
} elseif (isset($_POST["del_btn"])) {
    // Delete was clicked

    // check if the deleter is a grader or TA
    if ($type == "TA") {
        // delete specific post from discussion if TA is the TA of their specific class and section
        $query3 = "DELETE D FROM discussion D WHERE D.student_id = " . $student_delete_id . " AND D.course_id = " . $course_id .
        " AND D.section_id = " . $section_id . " AND D.semester = '" . $semester_name . "' AND D.year = " . $year_num . " AND EXISTS " .
        "( SELECT 1 FROM takes T WHERE D.student_id = T.student_id AND D.course_id = T.course_id AND D.section_id = T.section_id AND D.semester = T.semester AND D.year = T.year ) " .
        "AND EXISTS ( SELECT 1 FROM teacher_assistant TA WHERE TA.student_id = " . $student_id .
        " AND D.course_id = TA.course_id AND D.section_id = TA.section_id AND D.semester = TA.semester AND D.year = TA.year )";
        $result3 = mysqli_query($connection, $query3) or die ("Query #3 failed: " . mysqli_error($connection));
        $was_deleted = mysqli_affected_rows($connection) > 0;
        if (!$was_deleted) {
            die ("Deletion failed.");
        }
    } elseif ($type == "GRADER") {
        // delete specific post from discussion if Grader is the grader of their specific class and section
        $query3 = "DELETE D FROM discussion D WHERE D.student_id = " . $student_delete_id . " AND D.course_id = " . $course_id .
        " AND D.section_id = " . $section_id . " AND D.semester = '" . $semester_name . "' AND D.year = " . $year_num . " AND EXISTS " .
        "( SELECT 1 FROM takes T WHERE D.student_id = T.student_id AND D.course_id = T.course_id AND D.section_id = T.section_id AND D.semester = T.semester AND D.year = T.year ) " .
        "AND EXISTS ( SELECT 1 FROM grader G WHERE G.student_id = " . $student_id .
        " AND D.course_id = G.course_id AND D.section_id = G.section_id AND D.semester = G.semester AND D.year = G.year )";
        $result3 = mysqli_query($connection, $query3) or die ("Query #3 failed: " . mysqli_error($connection));
        $was_deleted = mysqli_affected_rows($connection) > 0;
        if (!$was_deleted) {
            die ("Deletion failed.");
        }
    } else {
        die("Please select either TA or Grader for deleting posts.");
    }

    // display posts/replies from discussion after post deletion
    $query4 = "SELECT S.name, D.content FROM student S, discussion D, takes T WHERE D.course_id = " . $course_id .
    " AND D.section_id = " . $section_id . " AND D.semester = '" . $semester_name . "' AND D.year = " . $year_num .
    " AND D.student_id = T.student_id AND D.course_id = T.course_id AND D.section_id = T.section_id AND" .
    " D.semester = T.semester AND D.year = T.year AND D.student_id = S.student_id AND T.student_id = S.student_id";
    $result4 = mysqli_query($connection, $query4) or die ("Query #4 failed: " . mysqli_error($connection));
    while ($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
        echo "<strong>" . $row["name"] . "</strong>: " . $row["content"] . "<br><br>";
    }
    mysqli_free_result($result4);
}

mysqli_close($connection);

?>