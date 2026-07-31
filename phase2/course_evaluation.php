<?php
// --- 1. PHP LOGIC (runs first, decides what happened) ---

$submitted   = false;
$success     = false;
$errorMsg    = "";
$courseTitle = "";
$finalGrade  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;

    $connection = mysqli_connect("localhost", "root", "", "db2");
    if (!$connection) {
        die("Could not connect: " . mysqli_connect_error());
    }

    $student_id = $_POST["student_id"];
    $course_id  = $_POST["course_id"];
    $section_id = $_POST["section_id"];
    $semester   = $_POST["semesterSelector"];
    $year       = intval($_POST["year_id"]);
    $rating     = intval($_POST["rateSelector"]);
    $comment    = $_POST["comments"];

    // --- Insert only if enrolled and not already evaluated ---
    $query1 = "INSERT INTO course_evaluation
               SELECT ?, ?, ?, ?, ?, ?, ?
               FROM takes T
               WHERE T.student_id = ?
               AND T.course_id = ?
               AND T.section_id = ?
               AND T.semester = ?
               AND T.year = ?
               AND NOT EXISTS (
                   SELECT 1 FROM course_evaluation E
                   WHERE E.student_id = ?
                   AND E.course_id = ?
                   AND E.section_id = ?
                   AND E.semester = ?
                   AND E.year = ?
               ) LIMIT 1";

    $stmt1 = mysqli_prepare($connection, $query1);
    mysqli_stmt_bind_param(
        $stmt1,
        "ssssiisssssissssi",
        $student_id, $course_id, $section_id, $semester, $year, $rating, $comment,
        $student_id, $course_id, $section_id, $semester, $year,
        $student_id, $course_id, $section_id, $semester, $year
    );
    mysqli_stmt_execute($stmt1);

    if (mysqli_stmt_affected_rows($stmt1) > 0) {
        $success = true;

        // --- Fetch title and grade to display ---
        $query2 = "SELECT C.title, T.grade
                   FROM takes T
                   JOIN course C ON T.course_id = C.course_id
                   WHERE T.student_id = ?
                   AND T.course_id = ?
                   AND T.section_id = ?";

        $stmt2 = mysqli_prepare($connection, $query2);
        mysqli_stmt_bind_param($stmt2, "sss", $student_id, $course_id, $section_id);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        if ($row = mysqli_fetch_assoc($result2)) {
            $courseTitle = $row["title"];
            $finalGrade  = $row["grade"] ?: "Not posted yet";
        }

        mysqli_stmt_close($stmt2);
    } else {
        $errorMsg = "Either you are not enrolled in this section, or you have already submitted an evaluation.";
    }

    mysqli_stmt_close($stmt1);
    mysqli_close($connection);
}
?>
<!-- --- 2. HTML RENDERING (plain markup, no echo) --- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Evaluation Result</title>
</head>
<body>

<?php if ($submitted): ?>
    <?php if ($success): ?>
        <h2>Success! Evaluation Submitted.</h2>
        <p>
            <strong>Course:</strong> <?= htmlspecialchars($courseTitle) ?><br>
            <strong>Your Final Grade:</strong> <?= htmlspecialchars($finalGrade) ?>
        </p>
    <?php else: ?>
        <h3>Submission Failed</h3>
        <p><?= htmlspecialchars($errorMsg) ?></p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>