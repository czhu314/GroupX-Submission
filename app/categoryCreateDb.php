<?php

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'id16152105_root';
$DATABASE_PASS = 'UniversityExeter56?';
$DATABASE_NAME = 'id16152105_usernames';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


//sql statement
if ($stmt = $con->prepare('SELECT eventType FROM events WHERE eventName = ?')) {
    
    if(strlen($_POST['charcode']) != 3){
       $_SESSION["error"] = "the category code must be 3 characters EXACTLY";
    }
    
    
    
    header('Location: Category_create.php');
    
    $makeforum = $_POST['makeforum'];
    $forumid = null;
    if (makeforum == true){
        $forumid = rand(111111,999999);
    }

    $categoryname = $_POST['cname'];
    $charcode = $_POST['charcode'];
    $query = "INSERT INTO category ( category_name, category_code , forum_id) VALUES ('$categoryname', '$charcode', $forumid)";

    mysqli_query($con, $query);
    
    
    
}