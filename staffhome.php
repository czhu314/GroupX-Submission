<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'u299197478_groupx';
$DATABASE_PASS = 'Coursework69';
$DATABASE_NAME = 'u299197478_groupx';
// Try and connect
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$email = $_SESSION['name'];
$sql = "SELECT id, fname FROM usernames WHERE email = '$email'";
$result = $con->query($sql);
    if (!empty($result) && $result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $userid = $row['id'];
            $fname = $row['fname'];
        }
    }
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
<div class="main">
    <video autoplay loop muted id="video" plays-inline>
        <source src="assets/video/exeter.mp4" type="video/mp4">
    </video>
    <div class="overlay"></div>
    <div class="navbar">
        <div class="logo">GROUP <span>X</span></div>
        <ul>
            <li><a href="app/addEvents.html" id="cname"> ADD EVENTS</a></li>
            <li><a href="app/staffRandomNumber.php" id="cname">ADD POINTS</a></li>
            <li><a href="app/staffleaderboard.php" id="cname">ADD LEADERBOARDS</a></li>
            <li><a href="logout.php" id="cname">LOG OUT</a></li>
        </ul>
    </div>
    <div class="heading">
        <h1 class="head">HELLO <span><?php echo strtoupper($fname)?></span></h1>
        <br>
        <h3 class="sub"></h3>
        <div class="btns">
            <a class="btn1" href="/app/eventsViewStaff.php">See All Events</a>
        </div>
    </div>
</div>
</body>
</html>