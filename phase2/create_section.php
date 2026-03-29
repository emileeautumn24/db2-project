<?php
// Connection to your db2 database
$conn = mysqli_connect('localhost', 'root', '', 'db2') or die(mysqli_error($conn));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // This part is the "Magic": it converts "00000001" to "1" 
    // so it matches your data.sql exactly.
    $cid  = strval(intval($_POST['course_id'])); 
    $sid  = strval(intval($_POST['section_id']));
    $iid  = strval(intval($_POST['instructor_id']));

    $bld  = $_POST['building'];      
    $room = $_POST['room_number'];
    $tid  = $_POST['time_slot_id'];
    $sem  = $_POST['semester'];
    $year = $_POST['year'];

    // 1. Get capacity from the classroom table (matches 'Ball', '208', etc)
    $room_check = "SELECT capacity FROM classroom WHERE building = '$bld' AND room_number = '$room'";
    $room_res = mysqli_query($conn, $room_check);
    $room_data = mysqli_fetch_assoc($room_res);

    if (!$room_data) {
        die("Error: The room '$bld $room' does not exist in your data.sql.");
    }
    $capacity = $room_data['capacity'];

    // 2. Check if the instructor already has 2 classes (Project Requirement)
    $inst_query = "SELECT s.time_slot_id FROM teaches t 
                   JOIN section s ON t.course_id = s.course_id AND t.section_id = s.section_id 
                   AND t.semester = s.semester AND t.year = s.year
                   WHERE t.instructor_id = '$iid' AND t.semester = '$sem' AND t.year = $year";
    $inst_res = mysqli_query($conn, $inst_query);
    
    if (mysqli_num_rows($inst_res) >= 2) {
        die("Error: Instructor $iid is already teaching 2 sections.");
    }

    // 3. INSERT the new section
    $query_sec = "INSERT INTO section (course_id, section_id, semester, year, building, room_number, time_slot_id, capacity) 
                  VALUES ('$cid', '$sid', '$sem', $year, '$bld', '$room', '$tid', 15)";

    if (mysqli_query($conn, $query_sec)) {
        // 4. Link the instructor in the teaches table
        $query_teach = "INSERT INTO teaches (instructor_id, course_id, section_id, semester, year) 
                        VALUES ('$iid', '$cid', '$sid', '$sem', $year)";
        
        if (mysqli_query($conn, $query_teach)) {
            echo "<h2>Success! Section Created</h2>";
            echo "Successfully created Section $sid for Course $cid.";
        }
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>