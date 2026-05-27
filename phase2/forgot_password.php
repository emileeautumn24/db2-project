<?php /** @noinspection SqlNoDataSourceInspection */

$username = $_POST["user_input"];
$new_password = $_POST["new_password_input"];
$retype_new_password = $_POST["retype_new_password_input"];

$user_type = isset($_POST["roleSelector"]) ? $_POST["roleSelector"] : null;
if ($user_type === null) {
    die("Please select user type.");
}
if ($new_password != $retype_new_password) {
    die("New password and retyped new password do not match.");
}

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// checks if reset password button is clicked
if (isset($_POST["reset_btn"])) {
    if ($user_type == "STUDENT") {
        $query0 = "UPDATE student_account SET password = '" . $new_password . "' WHERE student_id = " . $username;
        $result0 = mysqli_query($connection, $query0) or die ("Reset password failed." . mysqli_error($connection));
        $was_updated = mysqli_affected_rows($connection) > 0;
        if ($was_updated) {
            echo "Reset password is successful!<br>";
        } else {
            die ("Reset password failed.");
        }
    } elseif ($user_type == "INSTRUCTOR") {
        $query0 = "UPDATE instructor_account SET password = '" . $new_password . "' WHERE instructor_id = " . $username;
        $result0 = mysqli_query($connection, $query0) or die ("Reset password failed." . mysqli_error($connection));
        $was_updated = mysqli_affected_rows($connection) > 0;
        if ($was_updated) {
            echo "Reset password is successful!<br>";
        } else {
            die ("Reset password failed.");
        }
    }
}

mysqli_close($connection);
?>