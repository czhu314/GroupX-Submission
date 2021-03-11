<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'u299197478_groupx';
$DATABASE_PASS = 'Coursework69';
$DATABASE_NAME = 'u299197478_groupx';

$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME, 3306);
if ($conn->connect_error) {
    die("Error connecting to database " . $conn->connect_error);
}

$email = $_SESSION['name'];
$sql = "SELECT id FROM usernames WHERE email = '$email'";
$result = $conn->query($sql);
if (!empty($result) && $result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $userid = $row['id'];
    }
}


// Find the user ID based on the login information (probably just using cookies).
$sql = "SELECT * FROM profileinfo WHERE (userID = '$userid')";
$result = $conn->query($sql);

if ($result->num_rows == 1)
{
    $row = $result->fetch_assoc();
} else {
    echo "user doesn't exist";
}
$conn->close();
?>
<html>
<head
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="../assets/css/editprofile3.css" type="text/css">
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
        <h1 class="head">Update <span>Profile</span></h1>
        <form method="POST" enctype="multipart/form-data" action=updateDetails.php>
            <div>
                <label for="profileName"><b>Name</b></label>
                <input type="text" value = "<?php echo $row['fullName']?>" name="profileName" id = "profileName" required>
            </div>
            <br>
            <div class="upload">
                <?php if ($row["imageType"] == NULL)
                {
                    echo '<img id="profileImage" src="defaultPFP.png" height="100" width="100">';
                } else {
                    echo '<img id="profileImage" src="displayPFP.php?image_id=' . $userid . '" height = "100" width="100">';
                }?>
                <input type="file" accept="image/*" name="file" id="file" onchange="loadFile(event)" style="display: none;"></p>
                <p><label for="file" class="button3" style="cursor: pointer;">Edit Profile Picture</label></p>
                <p><label for="profileImage">Please ensure your Profile Picture is less than <b>64kb</b></label></p>
            </div>
            <div class="security">
                <u><b>Security and Privacy</b></u><br>
                <br>
                <label for="showTreasure">Display my Treasure Hunt points</label>
                &#8205
                <?php if($row['treasurePointsPublic'] == 1) {
                    echo "<input type='checkbox' id='showTreasure' name='showTreasure' checked><br>";
                } else {
                    echo "<input type='checkbox' id='showTreasure' name='showTreasure'><br>";
                }?>
                <label for="showStreak">Display my Streak</label>
                &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205 &#8205
                <?php if($row['streakPublic'] == 1) {
                    echo "<input type='checkbox' id='showStreak' name='showStreak' checked><br>";
                } else {
                    echo "<input type='checkbox' id='showStreak' name='showStreak'><br>";
                }?>
            </div>
            <div class="social">
                <br><u><b>Link your Social Media</b></u><br>
                <br>
                <label for="linkFacebook"><b>Facebook</b></label>
                &#8205 &#8205
                <i class="fab fa-facebook-f" style="color:blue"></i>
                <input type="text" name="linkFacebook" id = "linkFacebook" value="<?php echo $row['facebookLink']?>"><br>
                <label for="linkTwitter"><b>Twitter</b></label>
                &#8205 &#8205 &#8205 &#8205 &#8205 &#8205
                <i class="fab fa-twitter" style="color:lightskyblue"></i>
                <input type="text" name="linkTwitter" id = "linkTwitter" value = "<?php echo $row['twitterLink']?>"><br>
                <label for="linkInstagram"><b>Instagram</b></label>
                <i class="fab fa-instagram" style="color:#FC94AF"></i>
                <input type="text" name="linkInstagram" id = "linkInstagram" value = "<?php echo $row['instagramLink']?>"><br>
            </div>
            <br>
            <div class="submit">
                <input type="submit" name="submitChanges" value="Submit Changes" class="button1">
            </div>
            <br>
            <div class="cancel">
                <button class="button2" onclick="location.href='profileView.php';">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    var loadFile = function(event) {
        if (!(event.target.files[0]['type'].split('/')[0] === 'image'))
        {
            window.alert("Please ensure you only upload image files");
            document.getElementById('file').value = "";
            return;
        }
        var image = document.getElementById('profileImage')
        var imgsize = event.target.files[0].size/1024;
        if (imgsize > 64)
        {
            window.alert("Please ensure your image file is less than 64kb")
            document.getElementById('file').value = ""
            <?php if ($row['imageType'] == NULL)
        {
            echo 'image.src = "defaultPFP.png"';
        } else {
            echo 'image.src = "displayPFP.php?image_id='.$row['userID'].'"';
        }?>
        } else {
            image.src = URL.createObjectURL(event.target.files[0])
        }
    };
</script>
</body>
</html>