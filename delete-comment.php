<?php
 

include "config.php";

$comment_id = $_POST['to-be-deleted'];
$post_id = $_POST['post_id'];



$sql = "DELETE FROM user_comment WHERE comment_id = $comment_id";
$result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

if($result) {
    echo "<script>
        window.onload = function() {
            window.location.href='main.php#post-3r429cibhe" . $post_id . "';
        };
    </script>";
    exit; // Ensure script stops execution after redirect
} else {
    mysqli_close($conn);
    echo "post not deleted try again";
}
?>