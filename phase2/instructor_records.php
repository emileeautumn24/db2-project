<?php
$connection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die('Could not connect: ' . mysqli_error($connection));

$iid_locked = isset($_POST['instructor_id']) ? $_POST['instructor_id'] : '';
$readonly_attr = $iid_locked !== '' ? 'readonly' : '';
?>
<h2>Instructor Teaching Records</h2>

<form method="post">
    Instructor ID: <input type="text" name="instructor_id" value="<?= htmlspecialchars($iid_locked) ?>" <?= $readonly_attr ?> required>
    Course ID (Optional): <input type="text" name="course_id">
    Section ID (Optional): <input type="text" name="section_id">
    <input type="submit" value="View Records">
</form>
<hr>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $iid = $_POST['instructor_id'];
    $cid = $_POST['course_id'];
    $sid = $_POST['section_id'];

    if (empty($sid)):
        $stmt = mysqli_prepare($connection,
            "SELECT course_id, section_id, semester, year FROM teaches WHERE instructor_id = ?");
        mysqli_stmt_bind_param($stmt, "s", $iid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        ?>
        <h3>Sections Taught by Instructor <?= htmlspecialchars($iid) ?>:</h3>
        <table border="1">
            <tr><th>Course</th><th>Section</th><th>Semester</th><th>Year</th></tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['course_id']) ?></td>
                    <td><?= htmlspecialchars($row['section_id']) ?></td>
                    <td><?= htmlspecialchars($row['semester']) ?></td>
                    <td><?= htmlspecialchars($row['year']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php
        mysqli_stmt_close($stmt);

    else:
        $stmt = mysqli_prepare($connection,
            "SELECT S.name, T.grade
               FROM takes T, student S
              WHERE T.course_id = ? AND T.section_id = ?
                AND T.student_id = S.student_id");
        mysqli_stmt_bind_param($stmt, "ss", $cid, $sid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        ?>
        <h3>Roster for Course <?= htmlspecialchars($cid) ?>, Section <?= htmlspecialchars($sid) ?>:</h3>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result)):
                $grade = $row['grade'] ? $row['grade'] : "In Progress";
                ?>
                <li><strong><?= htmlspecialchars($row['name']) ?></strong> - Grade: <?= htmlspecialchars($grade) ?></li>
            <?php endwhile; ?>
        </ul>
        <?php
        mysqli_stmt_close($stmt);
    endif;
endif;

mysqli_close($connection);
?>
