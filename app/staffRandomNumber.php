<!DOCTYPE html>
<html lang="en">
<head>
    <title>Points Code Generator</title>
    <meta charset="UTF-8">
</head>

<body>

<h1>Points Code Generator</h1>
<form method="post" >
<div method ="post" class="container">
    <b>Subject/Society:</b><select name="eventName" id="eventName">
        <option value="COM">Computer Science</option>
        <option value="ENG">Engineering</option>
        <option value="MAT">Mathematics</option>
        <option value="PHY">Physics</option>
        <option value="PSY">Psychology</option>
        <option value="LAW">Law</option>
        <option value="ESH">English</option>
        <option value="MED">Medicine</option>
        <option value="BBS">Big Band Society</option>
        <option value="FBS">Football Society</option>
    </select><br>

    <b>Event Type:</b><select name="eventType" id="eventType">
        <option value="Lecture">Lecture</option>
        <option value="Workshop">Workshop</option>
        <option value="Seminar">Seminar</option>
        <option value="ExtraReading">Extra Reading</option>
        <option value="SocMeeting">Society Meeting</option>
        <option value="SocEvent">Society Event</option>
    </select><br>

    <label for="points"><b>Amount of Points:</b></label>
    <input type="number" min="0" step="1" placeholder="Enter Points" name="points" id="points" >
    <br>
                    <a type="submit" name="login" value="LOGIN">
                        <button>Register</button>
                    </a>
                    
</form>
<a href="/staffhome.php">BACK</a>
</div>
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
//isset() will check if the data exists.
if ( !isset($_POST['eventType'], $_POST['eventName']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the Event and Name fields!');
}
// REGISTER USER
//$code = $_POST['code'];
$eventName = $_POST['eventName'] ;
$eventType = $_POST['eventType'] ;
$points = $_POST['points'] ;
$code=rand(100000,900000);
echo "Code has been successfully generated!<br> Code:<input type='text' value='$code'/>";

$query = "INSERT INTO pointcodes (eventType, eventName, code, points) VALUES ( '$eventType', '$eventName', '$code','$points' )";
mysqli_query($con, $query);



?>

</center>
</body>







