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

    <div class="navbar">
        <div class="logo">GROUP <span>X</span></div>
      
    </div>
<div class="rankings">
            <center>
            <h3>Current Leaderboards</h3>
            <table class="rankingTable" style="margin-left:auto;margin-right:auto">
            <?php
            // run the query. Will return a resource or false.
            $subj_find = "SELECT subject, count(subject) FROM leaderboard GROUP BY subject HAVING count(subject) > 0";
            $result_b = mysqli_query($con,$subj_find);
            // if it ran OK
            if ($result_b) {
            // while I have more results, loop through them.
            // returning each result as an array.
	
            while ($subject = mysqli_fetch_array($result_b)) {
            // use the array keys to output the data.
            ?>
                <h4>Top 3 Students in <?php echo $subject["subject"]; ?></h4>
                <table id="leaderboard">
                    <tr>
                        <th>Rank</th>
                        <th>User</th>
                        <th>Points</th>
                    </tr>
            <tr>
            <td>
                <?php
                // a query to find top 3 students from each subject.
                $subject = $subject["subject"];
                $result = mysqli_query($con, "SELECT * FROM leaderboard WHERE subject='$subject' ORDER BY points DESC limit 0,3;");
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
            </td>

            <?php
            }
            }
            ?>
            <!-- Button to that runs javascript function, to reset leaderboard. -->
            <form onclick="myFunction()" method="post">
                <input type='button' value='Reset Leaderboard (Weekly)' name='delleaderboard'/>
            </form>
            <script>
                function myFunction() {
                    if (confirm("All the leaderboards will be deleted! Please take note of the TOP 3 students off ALL sujects.")){
                        window.location = "deleteleaderboard.php";

                    }
                }
            </script>
        </center>
        <a href="/staffhome.php">BACK</a>
</div>

