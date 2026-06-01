<?php /** @noinspection SqlNoDataSourceInspection */

$username            = $_POST["user_input"]              ?? "";
$new_password        = $_POST["new_password_input"]      ?? "";
$retype_new_password = $_POST["retype_new_password_input"] ?? "";
$user_type           = $_POST["roleSelector"]            ?? null;

if ($user_type === null) {
    die("Please select user type.");
}
if ($new_password !== $retype_new_password) {
    die("New password and retyped new password do not match.");
}

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// checks if reset password button is clicked
if (isset($_POST["reset_btn"])) {
    if ($user_type === "STUDENT") {
        $stmt = mysqli_prepare($connection,
            "UPDATE student_account SET password = ? WHERE student_id = ?");
        mysqli_stmt_bind_param($stmt, "ss", $new_password, $username);
        mysqli_stmt_execute($stmt);
 
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Reset password is successful!";
        } else {
            die("Reset password failed.");
        }
        mysqli_stmt_close($stmt);
 
    } elseif ($user_type === "INSTRUCTOR") {
        $stmt = mysqli_prepare($connection,
            "UPDATE instructor_account SET password = ? WHERE instructor_id = ?");
        mysqli_stmt_bind_param($stmt, "ss", $new_password, $username);
        mysqli_stmt_execute($stmt);
 
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Reset password is successful!";
        } else {
            die("Reset password failed.");
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($connection);
?>