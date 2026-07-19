
<?php
   include "config.php";
     
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
        $lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=mysqli_real_escape_string($conn,sha1($_POST['passwd']));
        $profile_img="profile-placeholder.jpg";
       
      
        $sql="SELECT username
          FROM register Where username='{$username}'";
        $result=mysqli_query($conn,$sql) or die("query failed:");
      if(mysqli_num_rows($result)>0)
      {
        header('Location: index.php?id=356a192b7913b04c54574d18c28d46e6395428ab');
        
      }
      else{
      $sql1 = "INSERT INTO register (firstname,lastname,username,Email,password1,profile_img)
      VALUES ('{$firstname}','{$lastname}', '{$username}', '{$email}','{$password}','{$profile_img}')";
          // $result1= or die("query failed: insert");
      
      if(mysqli_query($conn,$sql1))
      {
        
     header('Location: login.php?id=356a192b7913b04c54574d18c28d46e6395428ab');
      
      }
      else{ 
        echo "Query failed";
      }
      
      }
      mysqli_close($conn);
    
    
    ?>