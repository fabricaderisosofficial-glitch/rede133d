<?php
session_start(); // Start session at the beginning of the script

include "config.php";

$post_id = $_GET['post_id'];

// Delete from posts table
$sql = "DELETE FROM posts WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

// Delete from likes table
$sql = "DELETE FROM likes WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

// Delete from user_comment table
$sql = "DELETE FROM user_comment WHERE post_id = $post_id";
$result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

if($result) {
    header('Location: main.php');
    exit; // Ensure script stops execution after redirect
} else {
    mysqli_close($conn);
    echo "post not deleted try again";
}
?>