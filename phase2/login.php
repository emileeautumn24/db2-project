<?php /** @noinspection SqlNoDataSourceInspection */

$username = $_POST["user_input"] ?? "";
$password = $_POST["password_input"] ?? "";
$user_type = $_POST["roleSelector"] ?? null;
if ($user_type === null) {
    die("Please select user type.");
}

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// username is ID, password is full name with spaces, exactly how it's entered in the system
// check if log in button, forgot username button, or forgot password button is clicked
if (isset($_POST["log_btn"])) {
    // Log In was clicked

    if ($user_type == "STUDENT") {
        $stmt = mysqli_prepare($connection,
            "SELECT A.student_id, S.name
               FROM student S
               JOIN student_account A ON A.student_id = S.student_id
              WHERE A.student_id = ? AND A.password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
 
        if ($row) { ?>
            <h2>You're logged in! Welcome <?= htmlspecialchars($row["name"]) ?>!</h2>
            <h3>Student ID: <?= htmlspecialchars($row["student_id"]) ?></h3>
            <table style="border:0">
                <tr><td><a href="browse_register.html">Browse and Register</a></td></tr>
                <tr><td><a href="student_transcript.html">Student Transcript</a></td></tr>
                <tr><td><a href="discussion_board.html">Discussion Board</a></td></tr>
                <tr><td><a href="course_evaluation.html">Course Evaluation</a></td></tr>
            </table>
        <?php } else {
            die("Log in attempt failed.");
        }
        mysqli_stmt_close($stmt);
    } elseif ($user_type == "INSTRUCTOR") {
        $stmt = mysqli_prepare($connection,
            "SELECT A.instructor_id, I.name
               FROM instructor I
               JOIN instructor_account A ON A.instructor_id = I.instructor_id
              WHERE A.instructor_id = ? AND A.password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
 
        if ($row) { ?>
            <h2>You're logged in! Welcome <?= htmlspecialchars($row["name"]) ?>!</h2>
            <h3>Instructor ID: <?= htmlspecialchars($row["instructor_id"]) ?></h3>
            <table style="border:0">
                <tr><td><a href="advising.html?instructor_id=<?= urlencode($row["instructor_id"]) ?>">Advising</a></td></tr>
                <tr><td><a href="instructor_records.html">Instructor Teaching Records</a></td></tr>
            </table>
        <?php } else {
            die("Log in attempt failed.");
        }
        mysqli_stmt_close($stmt);
    } elseif ($user_type == "ADMIN") {
        if ($username === "00000000" && $password === "admin1234") { ?>
            <h2>You're logged in! Welcome admin!</h2>
            <h3>Admin ID: 00000000</h3>
            <table style="border:0">
                <tr><td><a href="create_section.html">Create Course Sections</a></td></tr>
                <tr><td><a href="ta_assignments.html">TA Assignments</a></td></tr>
                <tr><td><a href="grader_assignments.html">Grader Assignments</a></td></tr>
            </table>
        <?php } else {
            die ("Log in attempt failed.");
        }
    }

} elseif (isset($_POST["forgot_user_btn"])) {
    // Forgot Username was clicked, password entered

    if ($user_type === "STUDENT") {
        $stmt = mysqli_prepare($connection,
            "SELECT student_id FROM student_account WHERE password = ?");
        mysqli_stmt_bind_param($stmt, "s", $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
 
        if ($row) {
            echo "Your username is " . htmlspecialchars($row["student_id"]);
        } else {
            die("Forgot username failed.");
        }
        mysqli_stmt_close($stmt);
 
    } elseif ($user_type === "INSTRUCTOR") {
        $stmt = mysqli_prepare($connection,
            "SELECT instructor_id FROM instructor_account WHERE password = ?");
        mysqli_stmt_bind_param($stmt, "s", $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
 
        if ($row) {
            echo "Your username is " . htmlspecialchars($row["instructor_id"]);
        } else {
            die("Forgot username failed.");
        }
        mysqli_stmt_close($stmt);
 
    } elseif ($user_type === "ADMIN") {
        echo "Your username is 00000000";
    }

} elseif (isset($_POST["forgot_pass_btn"])) {
    // Forgot Password was clicked

    if ($user_type === "STUDENT" || $user_type === "INSTRUCTOR") { ?>
        <h2>Forgot Password</h2>
        <form action="forgot_password.php" method="post">
            <table style="border:0">
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="username" name="user_input"/></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" id="new_password" name="new_password_input"/></td>
                </tr>
                <tr>
                    <td>Retype New Password</td>
                    <td><input type="password" id="retype_new_password" name="retype_new_password_input"/></td>
                </tr>
                <tr>
                    <td>I am a:</td>
                    <td>
                        <input type="radio" id="student"    name="roleSelector" value="STUDENT"/>
                        <label for="student">Student</label>
                        <input type="radio" id="instructor" name="roleSelector" value="INSTRUCTOR"/>
                        <label for="instructor">Instructor</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <input type="submit" value="Reset Password" id="resetButton" name="reset_btn"/>
                    </td>
                </tr>
            </table>
        </form>
    <?php } elseif ($user_type === "ADMIN") {
        if ($username === "00000000") {
            echo "Your password is admin1234";
        } else {
            die("Forgot password failed.");
        }
    }
}

mysqli_close($connection);
?>