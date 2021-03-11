<?php
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
$sql = "SELECT id, fname, lname FROM usernames WHERE email = '$email'";
$result = $con->query($sql);
    if (!empty($result) && $result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $userid = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/premium/png-256-thumb/agenda-1765355-1501923.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter New Code</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
<div class="container">
    <h1>Enter Code To Recieve Points</h1>
    <form method="post">
        <label for="code"><b>Code</b></label><br>
        <div class="email">
            <input type="text" placeholder="Enter Your Generated Code For Points!" name="code" id="code" required>
        </div>
        <input class="enter" type="submit" name="enterCode" value="Enter Code">
    </form>
<?php
    if(isset($_POST['code'])){
        $search = $_POST['code']; //recieves code (will need a validation
        $code = "SELECT points, eventName FROM pointcodes WHERE code = '$search'"; //knows how many points it's worth
        $result2 = $con->query($code);
        if (!empty($result2) && $result2->num_rows > 0) {
        // output data of each row
            while($row = $result2->fetch_assoc()) {
                $subject = $row['eventName'];
                $points = $row['points'];                
            }
            $exists = "SELECT * FROM leaderboard WHERE userid = '$userid' AND subject = '$subject'";
            $result3 = $con->query($exists);
            if($result3->num_rows == 0){
                $sql = "INSERT INTO leaderboard (userid, name, subject, points)
                VALUES ('$userid', '$fname', '$subject', '$points')";
                if ($con->query($sql) === TRUE) {
                echo "New record created successfully";
                } 
                else {
                echo "Error: " . $sql . "<br>" . $con->error;
                }
            }else{
            echo 'else reached';
            if($result2){
                echo 'if reached';
                //while($row=mysqli_fetch_row($result2))
                //{
                    echo 'while';
                    //total user points
                    //(UPDATE leaderboard SET points = $total + $points WHERE userid = '$userid' AND subject = 'Total_Points') , 
                    //$query1 = "UPDATE leaderboard SET points = points + $points WHERE userid = '$userid' AND subject = 'Total_Points";
                    $query = "UPDATE leaderboard SET points = points + $points WHERE userid = '$userid' AND subject = '$subject'";
                    
                    //$query = '$query1 , $query2';
                    if ($con->query($query) === TRUE) {
                    echo "Record updated successfully for your subject!";
                    } 
                    else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                    }
                    $query2 = "UPDATE leaderboard SET points = points + $points WHERE userid = '$userid' AND subject = 'Total_Points'";
                    if ($con->query($query2) === TRUE) {
                    echo "Record updated successfully for your total points!";
                    } 
                    else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                    }
                //}
            }
            }
        }else{
            echo "Invalid Code.";
        }

    }
?>
   <a class="l1" href="home.php">Back</a>
</div>
</body>
</html>