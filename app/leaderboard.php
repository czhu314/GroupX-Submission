<html>
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
    ?>
<head>
    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/premium/png-256-thumb/agenda-1765355-1501923.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../assets/css/profile.css" type="text/css" runat="server">
</head>
<body>
    <?php
    $subject = $_GET['subject'];
    $userid = $_GET['userid'];
    ?>
<div class="container" id="container">
		<div class="overlay">
		</div>
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
				<div class="name">
					<h5>Leaderboard for the top 10 Students in <?php echo $subject; ?></h5>
					<h6>Top 3 students will be emailed each week to get their prices</h6>
				</div>
			<table id="leaderboard">
				<tr>
					<th>Rank</th>
					<th>User</th>
					<th>Points</th>
				</tr>
				<?php

				// $result = mysqli_query("SELECT name, points FROM leaderboard ORDER BY points DESC");
				$result = mysqli_query($con, "SELECT * FROM leaderboard WHERE subject='$subject' ORDER BY points DESC limit 0,10;");
				$rank = 1;

				if (mysqli_num_rows($result)) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>
							<td>{$rank}</td>
							  <td>{$row['name']}</td>
							  <td>{$row['points']}</td></tr>";

						$rank++;
					}
				}

				?>
			</table>
		</div>
		</div>
<a href="profileView.php?user_id=<?php echo $userid ?>" id="cname">BACK TO PROFILE</a>

</html>