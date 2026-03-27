<?php /** @noinspection SqlNoDataSourceInspection */

$username = $_POST["user_input"];
$password = $_POST["password_input"];
$user_type = isset($_POST["roleSelector"]) ? $_POST["roleSelector"] : null;
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
        $query0 = "SELECT student_id, name FROM student WHERE student_id = " . $username . " AND name = '" . $password . "'";
        $result0 = mysqli_query($connection, $query0) or die ("Log in attempt failed." . mysqli_error($connection));
        if ($row = mysqli_fetch_array($result0, MYSQLI_ASSOC)) {
            echo "<strong>You're logged in! Welcome " . $row["name"] . "!</strong><br>";
            echo "<strong>Student ID: " . $row["student_id"] . "</strong><br>";
        } else {
            die ("Log in attempt failed.");
        }
        mysqli_free_result($result0);
    } elseif ($user_type == "INSTRUCTOR") {
        $query0 = "SELECT instructor_id, name FROM instructor WHERE instructor_id = " . $username . " AND name = '" . $password . "'";
        $result0 = mysqli_query($connection, $query0) or die ("Log in attempt failed." . mysqli_error($connection));
        if ($row = mysqli_fetch_array($result0, MYSQLI_ASSOC)) {
            echo "<strong>You're logged in! Welcome " . $row["name"] . "!</strong><br>";
            echo "<strong>Instructor ID: " . $row["instructor_id"] . "</strong><br>";
        } else {
            die ("Log in attempt failed.");
        }
        mysqli_free_result($result0);
    } elseif ($user_type == "ADMIN") {
        if ($username == 00000000 && $password == 1234) {
            echo "<strong>You're logged in! Welcome admin!</strong><br>";
            echo "<strong>Admin ID: 00000000</strong><br>";
        } else {
            die ("Log in attempt failed.");
        }
    }

} elseif (isset($_POST["forgot_user_btn"])) {
    // Forgot Username was clicked, password entered

    if ($user_type == "STUDENT") {
        $query1 = "SELECT student_id, name FROM student WHERE name = '" . $password . "'";
        $result1 = mysqli_query($connection, $query1) or die ("Forgot username failed." . mysqli_error($connection));
        if ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            echo "Your username is " . $row["student_id"] . "<br>";
        } else {
            die ("Forgot username failed.");
        }
        mysqli_free_result($result1);
    } elseif ($user_type == "INSTRUCTOR") {
        $query1 = "SELECT instructor_id, name FROM instructor WHERE name = '" . $password . "'";
        $result1 = mysqli_query($connection, $query1) or die ("Forgot username failed." . mysqli_error($connection));
        if ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            echo "Your username is " . $row["instructor_id"] . "<br>";
        } else {
            die ("Forgot username failed.");
        }
        mysqli_free_result($result1);
    } elseif ($user_type == "ADMIN") {
        echo "Your username is 00000000<br>";
    }

} elseif (isset($_POST["forgot_pass_btn"])) {
    // Forgot Password was clicked, username entered

    if ($user_type == "STUDENT") {
        $query2 = "SELECT student_id, name FROM student WHERE student_id = " . $username;
        $result2 = mysqli_query($connection, $query2) or die ("Forgot password failed." . mysqli_error($connection));
        if ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "Your password is " . $row["name"] . "<br>";
        } else {
            die ("Forgot password failed.");
        }
        mysqli_free_result($result2);
    } elseif ($user_type == "INSTRUCTOR") {
        $query2 = "SELECT instructor_id, name FROM instructor WHERE instructor_id = " . $username;
        $result2 = mysqli_query($connection, $query2) or die ("Forgot password failed." . mysqli_error($connection));
        if ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "Your password is " . $row["name"] . "<br>";
        } else {
            die ("Forgot password failed.");
        }
        mysqli_free_result($result2);
    } elseif ($user_type == "ADMIN") {
        if ($username == 00000000) {
            echo "Your password is 1234<br>";
        } else {
            die ("Forgot password failed.");
        }
    }
}

mysqli_close($connection);
?>