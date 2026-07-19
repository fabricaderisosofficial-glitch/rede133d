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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instagram</title>
    <link rel="stylesheet" href="search.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;800&display=swap" rel="stylesheet">

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
            <div id="hover2" class="menu-bar find">
                <div><img src="./images/search.png" alt="search"></div>
                <div class="text">Search</div>
            </div>
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
            }
            ?>
            <a class="postman" href="profile.php">
                <div id="hover7" class="menu-bar">
                    <div><img id="profile" src="post-images/<?php echo $session_row['profile_img']; ?>" alt="profile">
                    </div>
                    <div class="text">Profile</div>
                </div>
            </a>
            <!-- <div id="hover4" class="menu-bar">
                <div><img src="./images/menu.png" alt="menu"></div>
                <div class="text">More</div>
            </div> -->
        </div>

        <div class="search">
            <!-- HTML form for username search -->
            <form id="search-form" method="post">
                <input type="text" name="username" placeholder="Search" autofocus>
                <button id="search-button" type="submit" value="Search"><img  src="./images/search.png" alt="search" height="25"></button>
            </form>

            <div class="profiles">
                <div style="padding: 10px; border-top: 1px solid lightgray; font-size: 15px; color: gray;">search result
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get the submitted username
                    $username = $_POST['username'];

                    // Connect to the database
                    include "config.php";

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    // Create a prepared statement
                    $stmt = $conn->prepare("SELECT * FROM register WHERE LOWER(username) LIKE LOWER(?) OR LOWER(firstname) LIKE LOWER(?) OR LOWER(lastname) LIKE LOWER(?)");


                    // Bind parameters
                    $searchTerm = "%" . $username . "%";
                    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);


                    // Execute the statement
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->get_result();

                    // Start the profiles div
                

                    // Fetch all rows and display them
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <a href="account.php?user_id=<?php echo $row['user_id']; ?>">
                        <div class="posthead suggestions">
                            <div class="profile-icon"><img src="post-images/<?php echo $row['profile_img']; ?>" alt=""
                                    height="40" width="40"></div>
                            <div>
                                <li style="font-size: 15px;"><?php echo $row["username"]; ?></li>
                                <li class="profile-loc">
                                    <?php echo ucfirst($row["firstname"]) . " " . ucfirst($row["lastname"]); ?>
                                </li>
                            </div>
                        </div>

                        </a>
                    <?php }

                    // End the profiles div
                

                    // Close the statement and the connection
                    $stmt->close();
                    $conn->close();
                }
                ?>

            </div>
            <div class="profiles profiles-all">
                <div style="padding: 10px; border-top: 1px solid lightgray; font-size: 15px; color: gray;">suggestions
                </div>
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
        <div class="menu-bottom">
            <a class="postman" href="main.php">
                <div id="hover1" class="menu-bar home">
                    <div><img src="./images/home.jpg" alt="home"></div>
                </div>
            </a>
            <div id="hover2" class="menu-bar find">
                <div><img src="./images/search.png" alt="search"></div>
            </div>

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
            <?php
            include "config.php";
            $session_sql = "select * from register where user_id={$_SESSION['user_id']}";
            $session_result = mysqli_query($conn, $session_sql) or die("Query failed");
            if (mysqli_num_rows($session_result) > 0) {
                $session_row = mysqli_fetch_assoc($session_result);
            }
            ?>

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
            
            <!-- <div class="posts">
                <img src="https://source.unsplash.com/random/144x144/?cars" alt="">
                <img src="https://source.unsplash.com/random/144x144/?animals" alt="">
                <img src="https://source.unsplash.com/random/144x144/?quotes" alt="">
                <img src="https://source.unsplash.com/random/144x144/?sky" alt="">
                <img src="https://source.unsplash.com/random/144x144/?space" alt="">
                <img src="https://source.unsplash.com/random/144x144/?planets" alt="">
                <img src="https://source.unsplash.com/random/144x144/?nature" alt="">
                <img src="https://source.unsplash.com/random/144x144/?mountains" alt="">
                <img src="https://source.unsplash.com/random/144x144/?citys" alt="">
                <img src="https://source.unsplash.com/random/144x144/?skyscrapers" alt="">
                <img src="https://source.unsplash.com/random/144x144/?coding" alt="">
                <img src="https://source.unsplash.com/random/144x144/?robot" alt="">
                <img src="https://source.unsplash.com/random/144x144/?spacex" alt="">
                <img src="https://source.unsplash.com/random/144x144/?internet" alt="">
                <img src="https://source.unsplash.com/random/144x144/?men" alt="">
                <img src="https://source.unsplash.com/random/144x144/?boy" alt="">
                <img src="https://source.unsplash.com/random/144x144/?puppies" alt="">
                <img src="https://source.unsplash.com/random/144x144/?women" alt="">
                <img src="https://source.unsplash.com/random/144x144/?girl" alt="">
                <img src="https://source.unsplash.com/random/144x144/?college" alt="">
                <img src="https://source.unsplash.com/random/144x144/?books" alt="">
            </div>    -->

    </div>
    
</body>

</html>