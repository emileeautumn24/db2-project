<?php

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect('localhost', 'root', '', 'db2') or die(mysqli_error($conn));

    $cid = $_POST['course_id'];
    $sid = $_POST['section_id'];
    $iid = $_POST['instructor_id'];
    $bld  = $_POST['building'];      
    $room = $_POST['room_number'];
    $rid = $_POST['classroom_id'];
    $tid = $_POST['time_slot_id'];
    $sem = $_POST['semester'];
    $year = $_POST['year'];

    // checking if time slot is full (max 2)
    $check_slot = "SELECT COUNT(*) as count FROM section WHERE time_slot_id = '$tid' AND semester = '$sem' AND year = $year";
    $res_slot = mysqli_query($conn, $check_slot);
    $row_slot = mysqli_fetch_assoc($res_slot);

    if ($row_slot['count'] >= 2) {
        die("error: time slot $tid is already full (max 2).");
    }

    // checking instructor Load (max 2)
    $check_inst = "SELECT COUNT(*) as count FROM teaches WHERE instructor_id = '$iid' AND semester = '$sem' AND year = $year";
    $res_inst = mysqli_query($conn, $check_inst);
    $row_inst = mysqli_fetch_assoc($res_inst);

    if ($row_inst['count'] >= 2) {
        die("error: instructor $iid is already teaching 2 sections this semester.");
    }

    //////////////////////////////////////

    // insert into section table
    $query_sec = "INSERT INTO section VALUES ('$cid', '$sid', '$sem', $year, '$bld', '$room', '$tid')";
    if (mysqli_query($conn, $query_sec)) {
        // insert into teaches table
        $query_teach = "INSERT INTO teaches VALUES ('$iid', '$cid', '$sid', '$sem', $year)";
        if (mysqli_query($conn, $query_teach)) {
            echo "successfully created section $sid for course $cid and assigned instructor $iid.";
        }
    } else {
        echo "error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "<h3>Please use the <a href='create_section.html'>Create Section Form</a>.</h3>";
}

?>