<?php

session_start();
include "config.php";







//  $Uid=$_SESSION["username"];
$user_id=$_SESSION['user_id'];
$post_id=mysqli_real_escape_string($conn,$_POST['pid']);
$username=mysqli_real_escape_string($conn,$_POST['uname']);
$user_comment=mysqli_real_escape_string($conn,$_POST['user-comment']);


$sql="INSERT INTO user_comment(username,post_id,user_comment,user_id)
VALUES ('{$username}','{$post_id}','{$user_comment}','{$user_id}')";


if(mysqli_multi_query($conn,$sql)){

    echo "<script>
        window.onload = function() {
            window.location.href='main.php#post-3r429cibhe" . $post_id . "';
        };
    </script>";
}
else{
    echo  "query failed";
}


?>