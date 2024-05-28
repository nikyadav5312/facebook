<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Clone</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="navbar">
        <div class="logo">Facebook</div>
        <div class="search-bar">
            <input type="text" placeholder="Search Facebook">
        </div>
        <div class="menu">
            <a href="welcome.php">Home</a>
            <a href="Profile.php">Profile</a>
            <a href="#">Messages</a>
            <a href="#">Notifications</a>
            <a href="#">Settings</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="sidebar">
            <ul>
                <li><a href="#">News Feed</a></li>
                <li><a href="#">Friends</a></li>
                <li><a href="#">Groups</a></li>
                <li><a href="#">Marketplace</a></li>
                <li><a href="#">Watch</a></li>
            </ul>
        </div>

        <div class="main">
            <div class="post-box">
                <textarea placeholder="What's on your mind?"></textarea>
                <button>Post</button>
            </div>

            <div class="post">
                <div class="post-header">
                    <div class="post-user">
                        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

                        <div class="post-time">2 hours ago</div>
                    </div>
                    <div class="post-content">
                        This is a sample post content.
                    </div>
                    <div class="post-actions">
                        <button>Like</button>
                        <button>Comment</button>
                        <button>Share</button>
                    </div>

                </div>
            </div>
            <section id="team" class="pb-5">
                <div class="container">
                    <div class="row">
                        <?php

                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "";
                        $dbname = "facebook";

                        $conn = new mysqli($servername, $username, $password, $dbname);


                        $sql = "SELECT * FROM users";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {


                                echo '<div class="col-xs-12 col-sm-6 col-md-4">';
                                echo '    <div class="image-flip">';
                                echo '        <div class="mainflip flip-0">';
                                echo '            <div class="frontside">';
                                echo '                <div class="card">';
                                echo '                    <div class="card-body text-center">';
                                echo '                        <p><img class=" img-fluid" src="IMG20230911201556.jpg" alt="card image"></p>';
                                echo '                       <h4 class="card-title">@'. $row["username"] . '</h4>';
                                echo '                        <a href="profiledata.php?username=' . urlencode($row["username"]) . '" class="btn btn-primary btn-sm">View Profile</a>';
                                echo '                    </div>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </section>

</body>

</html>