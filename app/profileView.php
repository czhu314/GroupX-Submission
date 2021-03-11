<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'u299197478_groupx';
$DATABASE_PASS = 'Coursework69';
$DATABASE_NAME = 'u299197478_groupx';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_GET['user_id'])) {
    $userid = $_GET['user_id'];
    $sql = "SELECT * FROM profileinfo WHERE (userID = '$userid')";
    $result = $con->query($sql);
    if ($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
    } else {
        $con->error = "Error executing";
    }
    $otherUser = true;
    
} else {
    $email = $_SESSION['name'];
    $otherUser = false;
    $sql = "SELECT id FROM usernames WHERE email = '$email'";
    $result = $con->query($sql);
    if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $userid = $row['id'];
        }
    }

    // Find the user ID based on the login information (probably just using cookies).
    $sql = "SELECT * FROM profileinfo WHERE (userID = '$userid')";
    $result = $con->query($sql);

    if ($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();
    } else {
        $con->error = "Error executing";
    }
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styleprofile.css">
    <!-- Used to import the show/hide password eye-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/profile.css" type="text/css" runat="server">
</head>
<body>
<div class="container" id="container">
    <div class="overlay"></div>
    <div class="navbar">
        <div class="logo">
            <a class="a" style="text-decoration: none;" href="../home.php">GROUP <span>X</span></a>
        </div>
        <ul>
            <li><a href="profileView.php">PROFILE</a></li>
            <li><a href="../forum/forum-home.php">FORUM</a></li>
            <li><a href="events.php">EVENTS</a></li>
            <li><a href="studentCodeRecieverNew.php" id="cname">GET POINTS</a></li>
            <li><a href="../logout.php">LOG OUT</a></li>
        </ul>
    </div>
    <div class="heading">
        <h1 class="head">My <span>Profile</span></h1>
        <div class="wrapper">
            <div class="picture">
                <?php if ($row["imageType"] == NULL)
                {
                    echo '<i class="fas fa-user-circle" style="font-size:100px;color:#000000"></i>';
                } else {
                    echo '<img src="displayPFP.php?image_id=' . $userid . '" height = "100" width="100">';
                }?>
            </div>
            <div class="name">
                <h2><?php echo $row["fullName"]?></h2>
            </div>
            <?php if ($otherUser == false) {
            echo '<form action="editProfile.php">';
            echo '<input type="submit" value="Change Settings" />';
            echo '</form>';
            }?>
            <!-- Display the meaning of each picture on hover
                (Star = All Points, Map = Treasure Hunt, Fire = Streak) -->
            <div class="points">
            <?php if($row['treasurePointsPublic'] == 1) {
                echo '<i class="fas fa-briefcase" style="font-size:32px;color:#3F301D"></i> ' . $row["treasureHuntPoints"];
            }
            if($row['streakPublic'] == 1) {
                echo '<i class="fa fa-fire-alt" style="font-size:32px;color:#DD571C"></i>' . $row["streak"];
            }?>
            </div>
        </div>
        <br>
        <div class="social_media">
            <a href=<?php echo $row["facebookLink"];?>><i class="fab fa-facebook-f" style="font-size:20px;color:#4267B2"></i></a>
            <a href=<?php echo $row["twitterLink"];?>><i class="fab fa-twitter" style="font-size:20px;color:#1DA1F2"></i></a>
            <a href=<?php echo $row["instagramLink"];?>><i class="fab fa-instagram" style="font-size:20px;color:#8a3ab9"></i></a>
        </div>
        <div class="rankings">
            <h3>Current Rankings:</h3>
            <table class="rankingTable" style="margin-left:auto; margin-right:auto">
                <?php
                // run the query. Will return a resource or false
                $subj_find = "SELECT subject FROM leaderboard WHERE userid = '$userid'";
                $result_b = mysqli_query($con,$subj_find);

                // if it ran OK
                if ($result_b) {
                    // while I have more results, loop through them
                    // returning each result as an array

                    while ($subject = mysqli_fetch_array($result_b)) {
                        // use the array keys (column names) to output the data
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <?php
                                echo $subject["subject"];
                                ?>
                            </td>
                            <td>
                                <button onclick="location.href='/app/leaderboard.php?subject=<?php echo $subject["subject"];?>&userid=<?php echo $userid ?>'">Go To</button></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

        <!--
                <li><a href=<?php /*echo $row["facebookLink"]?>><i class="fab fa-facebook-f"></i></a></li>
                <li><a href=<?php echo $row["twitterLink"]?>><i class="fab fa-twitter"></i></a></li>
                <li><a href=<?php echo $row["instagramLink"]*/?>><i class="fab fa-instagram"></i></a></li>

            --->
    </div>
</div>
</body>
</html>