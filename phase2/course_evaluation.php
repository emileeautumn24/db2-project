<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = mysqli_connect("localhost", "root", "", "db2") 
        or die("Could not connect: " . mysqli_error($connection));

    $student_id = strval(intval($_POST["student_id"]));
    $course_id  = strval(intval($_POST["course_id"]));
    $section_id = strval(intval($_POST["section_id"]));
    
    $semester   = $_POST["semesterSelector"];
    $year       = $_POST["year_id"];
    $rating     = intval($_POST["rateSelector"]);
    $comment    = mysqli_real_escape_string($connection, $_POST["comments"]);

    // PRAGMATIC LOGIC: Insert only if student exists in 'takes' for this section
    // and hasn't already evaluated it (NOT EXISTS).
    $query1 = "INSERT INTO course_evaluation 
               SELECT '$student_id', '$course_id', '$section_id', '$semester', $year, $rating, '$comment'
               FROM takes T 
               WHERE T.student_id = '$student_id' 
               AND T.course_id = '$course_id' 
               AND T.section_id = '$section_id' 
               AND T.semester = '$semester' 
               AND T.year = $year 
               AND NOT EXISTS (
                   SELECT 1 FROM course_evaluation E 
                   WHERE E.student_id = '$student_id' 
                   AND E.course_id = '$course_id' 
                   AND E.section_id = '$section_id' 
                   AND E.semester = '$semester' 
                   AND E.year = $year
               ) LIMIT 1";

    $result1 = mysqli_query($connection, $query1);
    
    // Check if the insert actually happened
    if (mysqli_affected_rows($connection) > 0) {
        echo "<h2>Success! Evaluation Submitted.</h2>";
        
        // UNLOCK GRADE: Now fetch the title and grade
        $query2 = "SELECT C.title, T.grade 
                   FROM takes T 
                   JOIN course C ON T.course_id = C.course_id 
                   WHERE T.student_id = '$student_id' 
                   AND T.course_id = '$course_id' 
                   AND T.section_id = '$section_id'";
        
        $result2 = mysqli_query($connection, $query2);
        if ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<strong>Course:</strong> " . $row["title"] . "<br>";
            echo "<strong>Your Final Grade:</strong> " . ($row["grade"] ?: "Not posted yet");
        }
    } else {
        // If 0 rows affected, it's either because they aren't enrolled or already evaluated
        echo "<h3>Submission Failed</h3>";
        echo "<p>Either you are not enrolled in this section, or you have already submitted an evaluation.</p>";
    }

    mysqli_close($connection);
}
?>