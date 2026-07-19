<?php
session_start(); // Start session at the beginning of the script

include "config.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, sha1($_POST['passwd']));

$sql = "SELECT *
        FROM register 
        WHERE username = '{$username}' AND password1 = '{$password}'";

$result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["username"] = $row['username'];
    $_SESSION["user_id"] = $row['user_id'];
    $_SESSION["firstname"] = $row['firstname'];
    $_SESSION["lastname"] = $row['lastname'];
    mysqli_free_result($result);
    mysqli_close($conn);
    header('Location: main.php');
    exit; // Ensure script stops execution after redirect
} else {
    mysqli_close($conn);
    echo "Username and password are incorrect";
}
?>