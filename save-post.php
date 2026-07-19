<?php
include "config.php";
//echo $filename=$_FILES['fileToUpload']['name'];
// $a=$_FILES['fileToUpload']['name'];
// echo $a;
// die();
if(isset($_FILES['fileToUpload']))
{
echo $filename=$_FILES['fileToUpload']['name'];
echo $filetype=$_FILES['fileToUpload']['type'];
echo $filesize=$_FILES['fileToUpload']['size'];
echo $tmp_name=$_FILES['fileToUpload']['tmp_name'];
echo $newname=time()."-".basename($filename);

 $target = "post-images/".$newname;;  
// $target_path = $target_path.basename( $_FILES['fileToUpload']['name']);   
  
if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {  
    //echo "File uploaded successfully!";  

} else{  
    echo "Sorry, file not uploaded, please try again!";  
}  





session_start();
 $Uid=$_SESSION["username"];
$user_id=$_SESSION["user_id"];

$location1=mysqli_real_escape_string($conn,$_POST['loc']);
$cap=mysqli_real_escape_string($conn,$_POST['caption']);



$sql="INSERT INTO posts(caption,location1,post_img,uid1,user_id)
VALUES ('{$cap}','{$location1}','{$newname}','{$Uid}',{$user_id})";

if(mysqli_multi_query($conn,$sql)){

    echo "<script>
        window.onload = function() {
            window.location.href='main.php';
        };
    </script>";
}
else{
    echo  "query failed";
}


}
else{

    die("please choose a file");
}


?>