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
    <link rel="stylesheet" href="../assets/css/studentcode.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
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
        <h2 class="head">Codes For <span>Points</span></h2>
        <p class="p">Enter Your Generated Code For Points!</p>
        <form method="post">
            <input placeholder='Enter Code' class='js-search' type="text" name="code" id="code" required>
            <i class="fa fa-search"></i>
        </form>
    </div>
<?php
	if(isset($_POST['code'])){
		$search = $_POST['code']; //recieves code (will need a validation
		$codeExists = "SELECT * FROM codevalidate WHERE id = '$userid' AND code = '$search'";
		$codevalidate = $con->query($codeExists);
		if($codevalidate->num_rows == 0){
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
					$sql = "INSERT INTO leaderboard (userid, name, subject, points)VALUES ('$userid', '$fname', '$subject', '$points')";
					if ($con->query($sql) === TRUE) {
						echo "New record created successfully";
					} 
					else {
						echo "Error: " . $sql . "<br>" . $con->error;
					}
					$query2 = "UPDATE leaderboard SET points = points + $points WHERE userid = '$userid' AND subject = 'Total Points'";
					echo "query2 passed";
					if ($con->query($query2) === TRUE) {
						echo "Record updated successfully for your total points!";
					} 
					else {
						echo "Error: " . $sql . "<br>" . $con->error;
					}
					$query3 = "INSERT INTO codevalidate (id,code) VALUES ('$userid','$search')";
					echo "query3 passed";
					if ($con->query($query3) === TRUE) {
						echo "Code Registered, you will not be able to use it again!";
					} 
					else {
						echo "Error: " . $sql . "<br>" . $con->error;
					}
				}else{
					if($result2){
						//echo 'if reached';
						//while($row=mysqli_fetch_row($result2))
						//{
						//echo 'while';
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
						$query2 = "UPDATE leaderboard SET points = points + $points WHERE userid = '$userid' AND subject = 'Total Points'";
						echo "query2 passed";
						if ($con->query($query2) === TRUE) {
							echo "Record updated successfully for your total points!";
						} 
						else {
							echo "Error: " . $sql . "<br>" . $con->error;
						}
						$query3 = "INSERT INTO codevalidate (id,code) VALUES ('$userid','$search')";
						echo "query3 passed";
						if ($con->query($query3) === TRUE) {
							echo "Code Registered, you will not be able to use it again!";
						} 
						else {
							echo "Error: " . $sql . "<br>" . $con->error;
						}
					//}
					}
				}
			}
		}else{
			echo "You have already redeemed this code!";
		}
	}else{
		echo "Invalid Code.";
	}


?>
</div>
</body>
</html>