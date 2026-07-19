<?php
include "config.php";
session_start();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '{$username}' OR email = '{$username}'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    if(password_verify($password, $row['password'])) {
        $_SESSION["username"] = $row['username'];
        $_SESSION["user_id"] = $row['user_id'];
        $_SESSION["user_type"] = $row['user_type'];
        $_SESSION["firstname"] = $row['firstname'];
        $_SESSION["lastname"] = $row['lastname'];
        
        header('Location: home.php');
        exit;
    } else {
        header('Location: login.php?msg=invalid');
        exit;
    }
} else {
    header('Location: login.php?msg=invalid');
    exit;
}

mysqli_close($conn);
?>