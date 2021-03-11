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
if ( !isset($_POST['eventName'], $_POST['eventType']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the email and password fields!');
}

if ($stmt = $con->prepare('SELECT eventType FROM events WHERE eventName = ?')) {

    $eventName = $_POST['eventName'];
    $eventType = $_POST['eventType'];
    $eventDescription = $_POST['eventDescription'];
    $query = "INSERT INTO events ( eventName, eventType , eventDescription) VALUES ('$eventName', '$eventType', '$eventDescription')";

    mysqli_query($con, $query);
    header('Location: addEvents.html');
}