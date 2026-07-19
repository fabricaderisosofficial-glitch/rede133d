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
    <link rel="stylesheet" href="search.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;800&display=swap" rel="stylesheet">
    <style>
        .frame {
            grid-template-columns: 1fr 4.5fr;
        }

        .menu-top {
            display: none;
        }

        #hover7,
        #hover2 {
            background-color: transparent;
            font-weight: normal;
            border-radius: 0;
        }

        #hover6 {
            background-color: rgb(247, 244, 247);
            font-weight: 700;
            border-radius: 0px 12px 12px 0px;
        }

        .profile {
            width: 600px;
            height: 80%;
            margin-top: 60px;
            background-color: rgb(247, 244, 247);
            border-radius: 20px;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        #image-preview {
            width: 250px;
            height: 250px;
            margin: 10px;
            background-color: rgb(214, 214, 215);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-container img {
            max-width: 250px;
            width: auto;
            max-height: 250px;
            height: auto;
        }

        .profile-credits {
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        input {
            position: relative;
            margin: 0;
            height: 38px;
            border-radius: 8px;
        }

        input[type=file] {
            width: 300px;
        }

        label {
            background-color: rgb(17, 88, 255);
            color: white;
            font-size: 13px;
            padding: 0.2rem;
            border-radius: 0.3rem;
            cursor: pointer;
        }

        button {
            height: 30px;
            color: white;
            background-color: rgb(39, 154, 248);
            border-radius: 7px;
            border: none;
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

            .menu2,
            .text {
                display: none;
            }

            .menu0 {
                align-items: center;
            }

            #logo {
                content: url("./images/blogo.png");
                height: 32px;
            }

            .frame {
                grid-template-columns: auto auto;
            }
        }

        @media only screen and (max-width:630px) {
            .menu {
                border: none;
            }
        }

        @media screen and (max-width:500px) {
            .frame {
                grid-template-columns: auto;
            }

            .posts,
            .profile {
                width: 100%;
            }

            #logo {
                margin: 0px 10px;
            }

            .menu-top {
                position: fixed;
                top: 0;
                background: white;
                display: grid;
                align-items: center;
                text-align: left;
                grid-template-columns: 2fr 0.3fr 0.3fr;
                width: 100vw;
                z-index: 100;
            }

            .menu-top img {
                height: 23px;
                margin: 10px 0px;
            }

            .profile {
                width: 80%;
            }

            .profile-container img {
                max-width: 250px;
                width: auto;
                max-height: 250px;
                height: auto;
            }

            .profile-credits {
                width: 250px;
            }

            input {
                width: 92%;
                height: 35px;
            }

            input[type=file] {
                width: 190px;
            }

            #hover4 {
                background-color: rgb(247, 244, 247);
                font-weight: 700;
                border-radius: 20px;
            }

            #hover6 {
                background-color: transparent;
                font-weight: normal;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>

    <div class="frame">
        <div class="menu menu0">
            <div><img id="logo" src="./images/Instagram.png" alt="logo"></div>


            <a class="postman" href="index.php">
                <div id="hover1" class="menu-bar home">
                    <div><img src="./images/home.jpg" alt="home"></div>
                    <div class="text">Home</div>
                </div>
            </a>
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
            <div id="hover6" class="menu-bar">
                <div><img src="./images/story.png" alt="add"></div>
                <div class="text">Create</div>
            </div>
            <?php 
            include "config.php";
            $session_sql = "select * from register where user_id={$_SESSION['user_id']}";
            $session_result = mysqli_query($conn, $session_sql) or die("Query failed");
            if (mysqli_num_rows($session_result) > 0) {
                $session_row = mysqli_fetch_assoc($session_result);
            }
            ?>
            <a class="postman" href="profile.php">
                <div id="hover7" class="menu-bar">
                    <div><img id="profile" src="post-images/<?php echo $session_row['profile_img']; ?>" alt="profile"></div>
                    <div class="text">Profile</div>
                </div>
            </a>
            <!-- <div id="hover4" class="menu-bar">
                <div><img src="./images/menu.png" alt="menu"></div>
                <div class="text">More</div>
            </div> -->
        </div>

        <div class="search">
            <div class="profile">
                <form action="save-post.php" method="post"  enctype="multipart/form-data">
                    <div class="profile-container">
                        <div id="image-preview">
                            <img id="preview" alt="" required>
                        </div>

                        <input id="choose-file" type="file" name="fileToUpload" accept="image/*" onchange="previewImage(event)" hidden required/>
                        <label for="choose-file">add image</label>
                        <div class="profile-credits">
                            <h4><?php echo $session_row['username']; ?></h4>
                            <input type="text"  name="caption"  placeholder="add caption" required>
                            <input type="text" name="loc"  placeholder="Location" required>
                            <button type="submit">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- <div class="menu-top">
            <div><img id="logo" src="./images/Instagram.png" alt="logo"></div>
            <div><img src="./images/heart.png" alt="notification"></div>
            <div><img src="./images/messenger.png" alt="chat"></div>
        </div> -->
        <div class="menu-bottom">
            <a class="postman" href="main.php">
                <div id="hover1" class="menu-bar home">
                    <div><img src="./images/home.jpg" alt="home"></div>
                </div>
            </a>
            <a class="postman" href="search.php">
            <div id="hover2" class="menu-bar find">
                <div><img src="./images/search.png" alt="search"></div>
            </div>
            </a>
            <div id="hover4" class="menu-bar">
                <div><img src="./images/story.png" alt="add"></div>
            </div>
            <!-- <div id="hover6" class="menu-bar">
                <div><img src="./images/instagram-reels.png" alt="reels"></div>
            </div> -->
            <a class="postman" href="profile.php">
            <div id="hover7" class="menu-bar">
                <div><img id="profile" src="post-images/<?php echo $session_row['profile_img']; ?>" alt="profile"></div>
            </div>
            </a>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var input = event.target;
            var image = document.getElementById('preview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>