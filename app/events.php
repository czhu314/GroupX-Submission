<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
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
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/events7.css">
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
        <h2 class="head">University of <span>Exeter</span> Events</h2>
        <p class="p">Here you will find all the events available for the University:</p>
        <div class="btns">
            <button onclick= switchContainer("container1") class="button1"><h3>Social</h3></button>
            <button onclick= switchContainer("container2") class="button2"><h3>Special</h3></button>
            <button onclick= switchContainer("container3") class="button3"><h3>Outdoor</h3></button>
            <button onclick= switchContainer("container4") class="button4"><h3>Limited</h3></button>
        </div>
        <div class="btns1">
            <a class="btn1" href="https://www.google.co.uk/maps/d/u/1/edit?mid=1RmuZKRKLzpa_bb5-1CTBR_OS2iyQg3nZ&usp=sharing" target="_blank" id="cname">Event Maps</a></li>
        </div>
    </div>
</div>
<div class="container1" id="container1">
    <h2>Social Events</h2>
    <?php
    $sql = "SELECT eventID , eventName, eventType, eventDescription FROM events WHERE eventType = 'Social'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br><u><b> Event ". $row["eventID"]. ":    " .$row["eventName"]. " </b></u><br>" . $row["eventDescription"] ." <br>";
        }
    } else {
        echo "0 results 1";
    }
    ?>
    <br>
    <a class="back" onclick = switchBack("container1") >Back</a>
</div>
<div class="container2" id="container2">
    <h2>Special Events</h2>
    <?php
    $sql2 = "SELECT eventID , eventName, eventType, eventDescription FROM events WHERE eventType = 'Special'";
    $result2 = $con->query($sql2);
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
            echo "<br><u><b> Event ". $row2["eventID"]. ":    " .$row2["eventName"]. " </b></u><br>" . $row2["eventDescription"] ." <br>";
        }
    } else {
        echo "0 results 2";
    }
    ?>
    <br>
    <a class="back" onclick = switchBack("container2") >Back</a>
</div>
<div class="container3" id="container3">
    <h2>Outdoor Events</h2>
    <?php
    $sql3 = "SELECT eventID , eventName, eventType, eventDescription FROM events WHERE eventType = 'Outdoors'";
    $result3 = $con->query($sql3);
    if ($result3->num_rows > 0) {
        // output data of each row
        while($row3 = $result3->fetch_assoc()) {
            echo "<br><u><b> Event ". $row3["eventID"]. ":    " .$row3["eventName"]. " </b></u><br>" . $row3["eventDescription"] ." <br>";
        }
    } else {
        echo "0 results 3";
    }
    ?>
    <br>
    <a class="back" onclick = switchBack("container3") >Back</a>
</div>
<div class="container4" id="container4">
    <h2>Limited Events</h2>
    <?php
    $sql4 = "SELECT eventID , eventName, eventType, eventDescription FROM events WHERE eventType = 'Limited'";
    $result4 = $con->query($sql4);
    if ($result4->num_rows > 0) {
        // output data of each row
        while($row4 = $result4->fetch_assoc()) {
            echo "<br><u><b> Event ". $row4["eventID"]. ":    " .$row4["eventName"]. " </b></u><br>" . $row4["eventDescription"] ." <br>";
        }
    } else {
        echo "0 results 4";
    }
    $con->close();
    ?>
    <br>
    <a class="back" onclick = switchBack("container4") >Back</a>
</div>
<script>
    function switchContainer(containerID){
        document.getElementById(containerID).style.display="block";
        document.getElementById("container").style.display="none";
    }
    function switchBack(containerID){
        document.getElementById(containerID).style.display="none";
        document.getElementById("container").style.display="block";
    }
</script>
</body>
</html>