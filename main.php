<?php
include "config.php";
session_start();

if (!isset($_SESSION["username"])) {
    header('Location: login.php');
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;800&display=swap" rel="stylesheet">

</head>

<body>

    <div class="frame">
        <div class="menu menu0">
            <div id="logo-div"><img id="logo" src="./images/Instagram.png" alt="logo"></div>


            <div id="hover1" class="menu-bar home">
                <div><img src="./images/home.jpg" alt="home"></div>
                <div class="text">Home</div>
            </div>
            <a class="postman" href="search.php">
                <div id="hover2" class="menu-bar find">
                    <div><img src="./images/search.png" alt="search"></div>
                    <div class="text">Search</div>
                </div>
            </a>
            <!-- <div id="hover3" class="menu-bar">
                <div><img src="./images/heart.png" alt="notification"></div>
                <div class="text">Notifications</div>
            </div>
            <div id="hover4" class="menu-bar">
                <div><img src="./images/messenger.png" alt="chat"></div>
                <div class="text">Messages</div>
            </div>
            <div id="hover5" class="menu-bar">
                <div><img src="./images/instagram-reels.png" alt="reels"></div>
                <div class="text">Reels</div>
            </div> -->
            <a class="postman" href="create.php">
                <div id="hover6" class="menu-bar">
                    <div><img src="./images/story.png" alt="add"></div>
                    <div class="text">Create</div>
                </div>
            </a>

            <?php
            include "config.php";
            $session_sql = "select * from register where user_id={$_SESSION['user_id']}";
            $session_result = mysqli_query($conn, $session_sql) or die("Query failed");
            if (mysqli_num_rows($session_result) > 0) {
                $session_row = mysqli_fetch_assoc($session_result);
                $sessionim = $session_row['profile_img'];
            } else {
                $sessionim = "profile-placeholder.jpg";
            }
            ?>
            <a class="postman" href="profile.php">
                <div id="hover7" class="menu-bar">
                    <div><img id="profile" src="post-images/<?php echo $sessionim ?>" alt="profile">
                    </div>
                    <div class="text">Profile</div>
                </div>
            </a>
            <form action="Logout.php" method="post">
                <button style="width: 100%; color: black;" type="submit" value="Logout">
                    <div id="hover4" class="menu-bar">
                        <div><img src="./images/logout.png" alt="logout"></div>
                        <div class="text">Logout</div>
                    </div>
                </button>
            </form>

        </div>
        <div class="menu-top">
            <div><img id="logo" src="./images/Instagram.png" alt="logo"></div>
            <!-- <div><img src="./images/menu.png" alt="menu"></div> -->
            <div>
                <form action="Logout.php" method="post">
                    <button type="submit" value="Logout"><img src="./images/logout.png" alt="menu"></button>
                </form>

            </div>

        </div>
        <div class="main menu menu1">





            <!-- post loop starting -->
            <?php
            include "config.php";
            $sql = "select * from posts ORDER BY post_id DESC";
            // $result = mysqli_query($conn,$sql) or die("Query failed");
            $result = mysqli_query($conn, $sql) or die('Invalid query: ' . mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <div class="post">
                        <div id="post-3r429cibhe<?php echo $row['post_id']; ?>"></div>

                        <div class="posthead">
                            <?php
                            include "config.php";
                            $profile_sql = "select * from register where user_id={$row["user_id"]}";
                            $profile_result = mysqli_query($conn, $profile_sql) or die("Query failed");
                            if (mysqli_num_rows($profile_result) > 0) {
                                $session_user_row = mysqli_fetch_assoc($profile_result);
                                $session_user_profile = $session_user_row['profile_img'];
                                // mysqli_free_result($profile_result);
                            } else {
                                $session_user_profile = "profile-placeholder.jpg";
                            }

                            ?>
                            <div class="profile-icon"><img src="post-images/<?php echo $session_user_profile ?>" alt=""
                                    height="40" width="40">
                            </div>




                            <div>
                                <li style="font-size: 15px; display: flex; align-items: center">
                                    <pr style="margin-right: 3px; font-weight: 600;">
                                        <?php echo $row["uid1"]; ?>
                                    </pr><img src="./images/pinpng.com-instagram-symbol-png-102490.png" height="14" alt="">
                                </li>
                                <li class="profile-loc">
                                    <?php echo $row["location1"]; ?>
                                </li>
                            </div>

                            <!-- <div><img id="three-dot-opener" src="./images/dots-three-vertical-3601841-3003583.png" alt=""
                                    height="22"></div> -->

                        </div>
                        <div>
                            <img class="pic" loading="lazy" src="post-images/<?php echo $row["post_img"]; ?>" alt="">
                        </div>

                        <!-- like-button-code -->

                        <?php
                        // Your existing code...
                
                        // Get the user ID and post ID
                        $user_id = $_SESSION['user_id'];
                        $post_id = $row['post_id'];

                        // Check if the user ID and post ID exist in the same row in the likes table
                        $stmtl = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
                        $stmtl->bind_param("ii", $user_id, $post_id);
                        $stmtl->execute();
                        $like_img_result = $stmtl->get_result();

                        if ($like_img_result->num_rows > 0) {
                            // The user ID and post ID exist in the same row
                            $like_img = 'redheart.png';
                        } else {
                            // The user ID and post ID do not exist in the same row
                            $like_img = 'heart.png';
                        }
                        ?>


                        <div class="postbottom">
                            <div class="bottom_menu">
                                <div>
                                    <form method="post" action="post-like.php">
                                        <input type="text" name="post_id" value="<?php echo $row['post_id']; ?>" hidden>
                                        <button type="submit"><img id="heart1" src="./images/<?php echo $like_img ?>" alt=""
                                                height="24"></button>
                                    </form>

                                </div>
                                <div id="comment-button-<?php echo $row['post_id']; ?>" class="open-comments"><img
                                        id="open-comments" src="./images/comment.png" alt="" height="25"></div>
                                <!-- <div><img src="./images/send.png" alt="" height="22"></div> -->

                                <?php
                                if ($_SESSION['user_id'] == $row['user_id']) {
                                    $delete_post = "display:block;";
                                } else {
                                    $delete_post = "display:none;";
                                }

                                ?>
                                <div style="display: flex; justify-content: end;">
                                    <a href="delete-post.php?post_id=<?php echo $row['post_id']; ?>"
                                        style="<?php echo $delete_post ?> font-size: 11px; color: rgb(39, 67, 248); font-family: sans-serif;">delete
                                        post</a>
                                </div>
                            </div>







                            <!-- post like -->




                            <!-- post like end -->











                            <?php
                            include "config.php";
                            $like_count_sql = "select *
                                    from likes 
                                    where  post_id={$row["post_id"]}";
                            $like_count_result = mysqli_query($conn, $like_count_sql) or die("Query failed");

                            if (mysqli_num_rows($like_count_result) > 0) {
                                $likes = mysqli_num_rows($like_count_result);
                            } else {
                                $likes = 0;
                            }
                            ?>

                            <div class="bottom-menu-margin" id="number1" style="font-size: 15px; font-weight: 700;">
                                <?php echo $likes ?> likes
                            </div>
                            <div class="bottom-menu-margin" style="font-size: 15px;">
                                <pr style="margin-right: 5px; font-weight: 700;">
                                    <?php echo $row["uid1"]; ?>
                                </pr>
                                <?php echo $row["caption"]; ?>
                            </div>

                            <?php
                            include "config.php";
                            $count_sql = "select *
                                    from user_comment 
                                    where  post_id={$row["post_id"]} Order by comment_id DESC";
                            $comment_count_result = mysqli_query($conn, $count_sql) or die("Query failed");

                            if (mysqli_num_rows($comment_count_result) > 0) {
                                $i = mysqli_num_rows($comment_count_result);
                            } else {
                                $i = 0;
                            }
                            ?>

                            <div class="bottom-menu-margin" style="font-size: 15px; opacity: 0.7;"><?php echo $i ?> comments
                            </div>

                            <form action="add-comment.php" method="post">
                                <input type="hidden" placeholder="Add a comment" name="pid"
                                    value="<?php echo $row["post_id"]; ?>">
                                <input type="hidden" placeholder="Add a comment" name="uname"
                                    value="<?php echo $_SESSION["username"]; ?>">

                                <div class="bottom-menu-margin"
                                    style="font-size: 15px; opacity: 0.7; margin-right: 8px; display: flex; justify-content: space-between;">
                                    <input type="text" placeholder="Add a comment" name="user-comment"><button
                                        type="submit">Add</button>

                                </div>
                            </form>


                        </div>

                        <!-- post comments count -->



                        <!-- post comments -->
                        <div class="post-comments" id="comment-block-<?php echo $row['post_id']; ?>">


                            <?php
                            include "config.php";
                            $comment_sql = "select *
                                             from user_comment 
                                            where  post_id={$row["post_id"]} Order by comment_id DESC";
                            $comment_result = mysqli_query($conn, $comment_sql) or die("Query failed");
                            if (mysqli_num_rows($comment_result) > 0) {

                                while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                                    ?>

                                    <?php
                                    include "config.php";
                                    $comment_user_sql = "select * from register where user_id={$comment_row['user_id']}";
                                    $comment_user_result = mysqli_query($conn, $comment_user_sql) or die("Query failed");
                                    if (mysqli_num_rows($comment_user_result) > 0) {
                                        $comment_user_row = mysqli_fetch_assoc($comment_user_result);
                                        $comment_user = $comment_user_row['profile_img'];
                                    } else {
                                        $comment_user = "profile-placeholder.jpg";
                                    }
                                    ?>



                                    <ul class="posthead">
                                        <li class="profile-icon"><img src="post-images/<?php echo $comment_user; ?>" alt="" height="25"
                                                width="25"></li>
                                        <li>
                                            <div style="font-size: 15px;  font-weight: bold;">
                                                <?php echo $comment_row["username"]; ?>
                                            </div>
                                        </li>
                                        <li style="font-size: 14px; margin-left: 5px; "><?php echo $comment_row["user_comment"]; ?></li>
                                        <li>
                                            <?php
                                            if ($_SESSION['user_id'] == $comment_row['user_id'] || $_SESSION['user_id'] == $row['user_id']) {
                                                $delete_comment = "display:block;";
                                            } else {
                                                $delete_comment = "display:none;";
                                            }

                                            ?>

                                            <form style="<?php echo $delete_comment ?>" action="delete-comment.php" method="post">
                                                <input type="text" name="post_id" value="<?php echo $comment_row['post_id'] ?>" hidden>
                                                <input type="text" name="to-be-deleted" value="<?php echo $comment_row['comment_id'] ?>"
                                                    hidden>
                                                <button type="submit"><img src="images/dustbin.png" height="15" alt=""></button>
                                            </form>

                                        </li>
                                    </ul>


                                    <?php
                                }
                            } else {
                                echo "<li>No comments found.</li>";
                            }
                            ?>
                        </div>

                        <script>
                            document.getElementById('comment-button-<?php echo $row['post_id']; ?>').addEventListener('click', function () {
                                var commentBlock = document.getElementById('comment-block-<?php echo $row['post_id']; ?>');
                                commentBlock.style.display = commentBlock.style.display === 'none' ? 'block' : 'none';
                            });
                        </script>

                    </div>


                    <!-- post loop end -->
                    <?php
                }
            }
            ?>


        </div>

        <div class="menu-bottom">
            <div id="hover1" class="menu-bar home">
                <div><img src="./images/home.jpg" alt="home"></div>
            </div>
            <a class="postman" href="search.php">
                <div id="hover2" class="menu-bar find">
                    <div><img src="./images/search.png" alt="search"></div>
                </div>
            </a>
            <a class="postman" href="create.php">
                <div id="hover4" class="menu-bar">
                    <div><img src="./images/story.png" alt="add"></div>
                </div>
            </a>
            <!-- <div id="hover6" class="menu-bar">
                <div><img src="./images/instagram-reels.png" alt="reels"></div>
            </div> -->

            <a class="postman" href="profile.php">
                <div id="hover7" class="menu-bar">
                    <div><img id="profile" src="post-images/<?php echo $session_row['profile_img']; ?>" alt="profile">
                    </div>
                </div>
            </a>
        </div>

        <div class="menu menu2">



            <div class="posthead profile-main">
                <div class="profile-icon"><img src="post-images/<?php echo $session_row['profile_img']; ?>" alt=""
                        height="55" width="55"></div>
                <div>
                    <li style="font-size: 15px;">
                        <?php echo $session_row["username"]; ?>
                    </li>
                    <li class="profile-loc">
                        <?php echo ucfirst($session_row["firstname"]) . " " . ucfirst($session_row["lastname"]); ?>
                    </li>
                </div>
                <div>
                    <form action="Logout.php" method="post">
                        <button id="logout" type="submit" value="Logout">Logout</button>
                    </form>
                </div>
            </div>


            <div>Discover</div>
            <?php
            include "config.php";
            $users_sql = "select * from register ORDER BY user_id DESC";
            // $result = mysqli_query($conn,$sql) or die("Query failed");
            $users_result = mysqli_query($conn, $users_sql) or die('Invalid query: ' . mysqli_error($conn));

            if (mysqli_num_rows($users_result) > 0) {
                while ($users_row = mysqli_fetch_assoc($users_result)) {
                    ?>

                    <a href="account.php?user_id=<?php echo $users_row['user_id']; ?>">
                        <div class="posthead suggestions">
                            <div class="profile-icon"><img src="post-images/<?php echo $users_row['profile_img']; ?>" alt=""
                                    height="40" width="40"></div>
                            <div>
                                <li style="font-size: 15px;"><?php echo $users_row["username"]; ?></li>
                                <li class="profile-loc">
                                    <?php echo ucfirst($users_row["firstname"]) . " " . ucfirst($users_row["lastname"]); ?>
                                </li>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>



        </div>

    </div>


    <script src="script.js"></script>

</body>

</html>