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


$email = $_SESSION['name'];
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
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styleprofile.css">
    <!-- Used to import the show/hide password eye-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/profileView.css" type="text/css" runat="server">
</head>
<body>
<div style="text-align: center;">
    <div class="header">
        <h1>My Profile</h1>
    </div>
    <form action="editProfile.php">
        <input type="submit" value="Change Settings" />
    </form>
    <div class="wrapper">
        <div class="picture">
            <?php if ($row["imageType"] == NULL)
            {
                echo '<img src="http://groupxcourseworkexeter.online/app/profile-picture-test.png" 
                height="100" width="100">';
            } else {
                echo '<img src="displayPFP.php?image_id=' . $userid . '" height = "100" width="100">';
            }?>
        </div>
        <div class = "name">
            <h2><?php echo $row["fullName"]?></h2>
        </div>
        <!-- Display the meaning of each picture on hover
            (Star = All Points, Map = Treasure Hunt, Fire = Streak) -->
        <div class="points"></div>
            <i class="fas fa-briefcase" style="font-size:32px;color:#3F301D"></i><?php echo $row["treasureHuntPoints"];?>
            <!-- Show the treasure hunt points -->
            <i class="fa fa-fire-alt" style="font-size:32px;color:#DD571C"></i> <?php echo $row["streak"];?>
            <!-- If we aren't doing streaks, just delete this part ^^ -->
        </div>
        <div class="social_media">
            <a href=<?php echo $row["facebookLink"];?>><i class="fab fa-facebook-f" style="font-size:32px;color:#3F301D"></i></a>
            <a href=<?php echo $row["twitterLink"];?>><i class="fab fa-twitter" style="font-size:32px;color:#3F301D"></i></a>
            <a href=<?php echo $row["instagramLink"];?>><i class="fab fa-instagram" style="font-size:32px;color:#3F301D"></i></a>
            <!--
                <li><a href=<?php /*echo $row["facebookLink"]?>><i class="fab fa-facebook-f"></i></a></li>
                <li><a href=<?php echo $row["twitterLink"]?>><i class="fab fa-twitter"></i></a></li>
                <li><a href=<?php echo $row["instagramLink"]*/?>><i class="fab fa-instagram"></i></a></li>
                
            --->
        </div>
        <div class="rankings">
            <h3>Current Rankings</h3>
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
            <button onclick="location.href='/app/leaderboard.php?subject=<?php echo $subject["subject"];?>'">Go To</button></td>
            </tr>
            <?php
            }
            }
            ?>
        </table>
        </div>
    </div>
    <a class="l1" href="http://groupxcourseworkexeter.online/home.php">Back</a>
</body>
</html>
