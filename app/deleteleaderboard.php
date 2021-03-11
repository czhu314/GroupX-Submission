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
// A query is made to update all the points column back to 0.
$reset_leaderboard = "UPDATE leaderboard SET points = 0";
$reset = mysqli_query($con,$reset_leaderboard);
// if query was successful display success message and return to staff leaderboard page.
if ($reset) {
    echo '<p>Leaderboard reset successfully!</p>';
    header( "refresh:1;url=staffleaderboard.php" );
    ?>  
<?php
// else show mysql error that occured.
  } else {
    echo '<p>Error reseting leaderboard from database!<br />'.
        'Error: ' . mysql_error() . '</p>';
  }
?>