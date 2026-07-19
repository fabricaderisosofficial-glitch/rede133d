<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;800&display=swap" rel="stylesheet">
    <style>
        .profile {
            width: 600px;
            margin-top: 20px;
        }

        .profile-container,
        ul {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .profile-container img {
            height: 140px;
            width: 140px;
            border-radius: 50%;
        }

        .profile-credits {
            height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        ul {
            justify-content: space-between;
            width: 300px;
        }

        ul li {
            list-style: none;
        }

        .posts {
            width: 700px;
            height: 100%;
            position: relative;
            margin-top: 10px;
            padding-top: 40px;
            background-color: rgb(241, 244, 255);
            border-radius: 10px;
        }

        .posts #profile_post_img_container {
            height: 235px;
            width: 100%;
            object-fit: fill;
            overflow: hidden;
            align-content: center;
            background-color: black;
            border: 1px solid white;
        }

        .posts img {
            width: 100%;
            height: auto;
        }

        .tag {
            position: absolute;
            width: 100%;
            top: 6px;
            text-align: center;
            font-weight: bold;
            background-color: rgb(241, 244, 255);
        }
        .return{
            width: 100%;
            padding: 10px;
        }

        @media only screen and (max-width:950px) {
            .posts {
                width: 600px;
            }

            .posts img {
                width: 100%;
                height: auto;
            }

        }

        @media only screen and (max-width:800px) and (min-width:500px) {

            .posts,
            .profile {
                width: 500px;
            }


        }



        @media screen and (max-width:500px) {


            .posts,
            .profile {
                width: 100%;
            }


            .profile-container img {
                height: 90px;
                width: 90px;
            }

            .posts {
                margin-top: 70px;
                padding-bottom: 60px;
            }

            /* .posts #profile_post_img_container{
              height: 150px;

            } */
            /* .posts img{
              height: 200px;
            } */

            ul {
                width: 250px;
                margin: 6px 0px;
            }

            ul li {
                text-align: center;
            }

            #hover7 {
                border-radius: 20px;
            }
        }
    </style>
</head>

<body>
    <?php
    include "config.php";

    if (isset($_GET['user_id'])) {
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = "SELECT * FROM register WHERE user_id = {$user_id}";
        $result = mysqli_query($conn, $sql) or die("Query failed");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            ?>
            <!-- // Output the user's profile details
        echo "Username: " . $row['username'] . "<br>";
        echo "Name: " . ucfirst($row['firstname']) . " " . ucfirst($row['lastname']); -->
            <div class="search">
                <div class="profile">
                    <div class="return"><img onclick="history.back()" src="images/arrow.png" height="20"> </div>
                    <div class="profile-container">
                        <img src="post-images/<?php echo $row['profile_img']; ?>" alt="">
                        <div class="profile-credits">
                            <div style="display: flex; align-items: center;">


                                <h3><?php echo $row["username"]; ?></h3>


                                <?php
                                include "config.php";
                                $user_id = $row["user_id"];
                                $count_sql = "select * from posts where user_id='{$user_id}'";
                                $comment_count_result = mysqli_query($conn, $count_sql) or die("Query failed");

                                if (mysqli_num_rows($comment_count_result) > 0) {
                                    $i = mysqli_num_rows($comment_count_result);
                                } else {
                                    $i = 0;
                                }
                                ?>

                            </div>
                            <ul>
                                <li><span style="font-weight: bold"><?php echo $i ?></span> Posts</li>
                                <!-- <li><span style="font-weight: bold">500</span> followers</li>
              <li><span style="font-weight: bold">100</span> following</li> -->
                            </ul>
                            <h4><?php echo ucfirst($row["firstname"]) . " " . ucfirst($row["lastname"]); ?></h4>
                            <p><?php echo $row["bio"]; ?></p>
                        </div>
                    </div>
                </div>

                <div class="posts">
                    <div class="tag">POSTS</div>
                    <?php
                    include "config.php";
                    //session_start();
                    $user_id = $row["user_id"];
                    $post_sql = "select * from posts where user_id='{$user_id}' ORDER BY post_id DESC";

                    $post_result = mysqli_query($conn, $post_sql) or die("Query failed");
                    if (mysqli_num_rows($result) > 0) {

                        while ($post_row = mysqli_fetch_assoc($post_result)) {


                            ?>
                            <div id="profile_post_img_container"><img src="post-images/<?php echo $post_row["post_img"]; ?>" alt="">
                            </div>

                            <?php
                        }
                    } else {
                        echo "<h1>No post<?h1>";
                    }
                    ?>
                </div>
            </div>

        <?php
        }
    }
    ?>
</body>

</html>