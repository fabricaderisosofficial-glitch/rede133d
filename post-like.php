<?php
session_start();
// Connect to the database
include "config.php";

    // Get the user ID and post ID from the form
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];

    // Check if the user has already liked this post
    $stmtm = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
    $stmtm->bind_param("ii", $user_id, $post_id);
    $stmtm->execute();
    $like_result = $stmtm->get_result();

    if ($like_result->num_rows > 0) {
        // The user has already liked this post, so unlike it
        $stmtm = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
    } else {
        // The user has not liked this post, so like it
        $stmtm = $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
    }

    // Execute the statement
    $stmtm->bind_param("ii", $user_id, $post_id);
    $stmtm->execute();

    // Close the statement
    $stmtm->close();

    // Redirect to the same page with JavaScript

    
    echo "<script>
        window.onload = function() {
            window.location.href='main.php#post-3r429cibhe" . $post_id . "';
        };
    </script>";



    
// Close the connection
$conn->close();
?>