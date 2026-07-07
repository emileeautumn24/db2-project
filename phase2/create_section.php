<?php
// Connection to your db2 database
$conn = mysqli_connect('localhost', 'root', '', 'db2');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$success = false;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cid  = $_POST['course_id'];
    $sid  = $_POST['section_id'];
    $iid  = $_POST['instructor_id'];
    $bld  = $_POST['building'];
    $room = $_POST['room_number'];
    $tid  = $_POST['time_slot_id'];
    $sem  = $_POST['semester'];
    $year = (int) $_POST['year'];

    // Wrap the whole flow so we can bail out early with a message
    // instead of die()-ing mid-script.
    do {
        // 1. Get capacity from the classroom table
        $stmt = mysqli_prepare($conn,
            "SELECT capacity FROM classroom WHERE building = ? AND room_number = ?");
        mysqli_stmt_bind_param($stmt, "ss", $bld, $room);
        mysqli_stmt_execute($stmt);
        $room_res = mysqli_stmt_get_result($stmt);
        $room_data = mysqli_fetch_assoc($room_res);
        mysqli_stmt_close($stmt);

        if (!$room_data) {
            $message = "Error: The room '$bld $room' does not exist.";
            break;
        }
        $capacity = $room_data['capacity'];

        // 2. Check if the instructor already has 2 classes
        $stmt = mysqli_prepare($conn,
            "SELECT s.time_slot_id FROM teaches t
             JOIN section s ON t.course_id = s.course_id AND t.section_id = s.section_id
             AND t.semester = s.semester AND t.year = s.year
             WHERE t.instructor_id = ? AND t.semester = ? AND t.year = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $iid, $sem, $year);
        mysqli_stmt_execute($stmt);
        $inst_res = mysqli_stmt_get_result($stmt);
        $inst_rows = mysqli_fetch_all($inst_res, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);

        if (count($inst_rows) >= 2) {
            $message = "Error: Instructor $iid is already teaching 2 sections.";
            break;
        }

        // Check if the instructor already has 1 class, and make sure the new class is consecutive
        if (count($inst_rows) == 1) {
            $res_time_code_id = $inst_rows[0]["time_slot_id"];

            $stmt = mysqli_prepare($conn,
                "SELECT day, start_hour, start_min, end_hour, end_min FROM time_slot WHERE time_slot_id = ?");
            mysqli_stmt_bind_param($stmt, "s", $tid);
            mysqli_stmt_execute($stmt);
            $new_row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($conn,
                "SELECT day, start_hour, start_min, end_hour, end_min FROM time_slot WHERE time_slot_id = ?");
            mysqli_stmt_bind_param($stmt, "s", $res_time_code_id);
            mysqli_stmt_execute($stmt);
            $org_row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);

            if ($new_row["day"] != $org_row["day"]) {
                $message = "Error: New class is not consecutive to the professor's existing class.";
                break;
            }

            $new_start_calc = (60 * $new_row["start_hour"]) + $new_row["start_min"];
            $new_end_calc   = (60 * $new_row["end_hour"]) + $new_row["end_min"];
            $org_start_calc = (60 * $org_row["start_hour"]) + $org_row["start_min"];
            $org_end_calc   = (60 * $org_row["end_hour"]) + $org_row["end_min"];

            $consecutive = false;
            if ($new_start_calc > $org_end_calc) {
                $consecutive = ($new_start_calc - $org_end_calc) <= 30;
            } else if ($org_start_calc > $new_end_calc) {
                $consecutive = ($org_start_calc - $new_end_calc) <= 30;
            }

            if (!$consecutive) {
                $message = "Error: New class is not consecutive to the professor's existing class.";
                break;
            }
        }

        // Check if this time slot is already used by 2 sections
        $stmt = mysqli_prepare($conn,
            "SELECT COUNT(*) as total FROM section WHERE time_slot_id = ? AND semester = ? AND year = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $tid, $sem, $year);
        mysqli_stmt_execute($stmt);
        $slot_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);

        if ($slot_data['total'] >= 2) {
            $message = "Error: Time slot '$tid' is already full. (Maximum 2 sections per slot allowed).";
            break;
        }

        // 3. INSERT the new section
        $stmt = mysqli_prepare($conn,
            "INSERT INTO section (course_id, section_id, semester, year, building, room_number, time_slot_id, capacity)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $fixed_capacity = 15;
        mysqli_stmt_bind_param($stmt, "sssisssi", $cid, $sid, $sem, $year, $bld, $room, $tid, $fixed_capacity);

        if (!mysqli_stmt_execute($stmt)) {
            $message = "Database Error: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            break;
        }
        mysqli_stmt_close($stmt);

        // 4. Link the instructor in the teaches table
        $stmt = mysqli_prepare($conn,
            "INSERT INTO teaches (instructor_id, course_id, section_id, semester, year)
             VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssi", $iid, $cid, $sid, $sem, $year);

        if (!mysqli_stmt_execute($stmt)) {
            $message = "Database Error: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
            break;
        }
        mysqli_stmt_close($stmt);

        $success = true;
        $message = "Successfully created Section $sid for Course $cid.";

    } while (false);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head><title>Create Section</title></head>
<body>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <?php if ($success): ?>
        <h2>Success! Section Created</h2>
        <p><?= htmlspecialchars($message) ?></p>
    <?php else: ?>
        <h2>Error</h2>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>