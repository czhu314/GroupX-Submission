<?php
include 'db-credentials.php';
session_start();
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (!$conn) {
    die('Could not connect: ');
}
//echo 'Connected successfully';
//echo "\n";
?>