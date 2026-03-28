<?php
$connection = mysqli_connect('localhost', 'root', '', 'db2') 
    or die('Could not connect: ' . mysqli_error($connection));

echo "<h2>Instructor Teaching Records</h2>";

// asking for Instructor ID and optionally a Section ID
?>
<form method="post">
    Instructor ID: <input type="text" name="instructor_id" required>
    Course ID (Optional): <input type="text" name="course_id">
    Section ID (Optional): <input type="text" name="section_id">
    <input type="submit" value="View Records">
</form>
<hr>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $iid = $_POST['instructor_id'];
    $cid = $_POST['course_id'];
    $sid = $_POST['section_id'];

    // Case 1: Show all sections taught by this instructor
    if (empty($sid)) {
        echo "<h3>Sections Taught by Instructor $iid:</h3>";
        $query = "SELECT course_id, section_id, semester, year 
                  FROM teaches 
                  WHERE instructor_id = $iid";
        
        $result = mysqli_query($connection, $query) or die('Query failed: ' . mysqli_error($connection));
        
        echo "<table border='1'><tr><th>Course</th><th>Section</th><th>Semester</th><th>Year</th></tr>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr><td>{$row['course_id']}</td><td>{$row['section_id']}</td><td>{$row['semester']}</td><td>{$row['year']}</td></tr>";
        }
        echo "</table>";
    } 
    // Case 2: Show specific roster for a section
    else {
        echo "<h3>Roster for Course $cid, Section $sid:</h3>";
        $query = "SELECT S.name, T.grade 
                  FROM takes T, student S 
                  WHERE T.course_id = '$cid' AND T.section_id = '$sid' 
                  AND T.student_id = S.student_id";
        
        $result = mysqli_query($connection, $query) or die('Roster query failed: ' . mysqli_error($connection));
        
        echo "<ul>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $grade = $row['grade'] ? $row['grade'] : "In Progress";
            echo "<li><strong>{$row['name']}</strong> - Grade: $grade</li>";
        }
        echo "</ul>";
    }
}
mysqli_close($connection);
?>

<br><br><a href='instructor_records.html'>[ Back to Search ]</a>