<?php
include "config.php";




if ($_FILES['fileUpload']['error'] == UPLOAD_ERR_NO_FILE) {
    $newname = $_POST['old_img'];

} else {
    echo $filename = $_FILES['fileUpload']['name'];
    echo $filetype = $_FILES['fileUpload']['type'];
    echo $filesize = $_FILES['fileUpload']['size'];
    echo $tmp_name = $_FILES['fileUpload']['tmp_name'];
    echo $newname = "profile-" . basename($filename);

    $target = "post-images/" . $newname;
    ;
    

    if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target)) {
        //echo "File uploaded successfully!";  

    } else {
        echo "Sorry, file not uploaded, please try again!";
    }

}



    session_start();
    $user_id = $_SESSION["user_id"];

    $sql = "UPDATE register SET username='{$_POST['username']}',firstname='{$_POST['firstname']}',lastname='{$_POST['lastname']}',profile_img='{$newname}',bio='{$_POST['bio']}'
        WHERE user_id={$user_id}";

    $result = mysqli_query($conn, $sql) or die("query failed");
    if ($result) {
        header('Location: profile.php');
    } else {
        echo "query failed";
    }




?>