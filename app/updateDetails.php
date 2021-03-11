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

if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        $imageProperties = getimageSize($_FILES['file']['tmp_name']);
        $imageType = $imageProperties['mime'];

        $sql = "UPDATE profileinfo SET profilePicture = '$imgData', imageType = '$imageType' WHERE userID = '$userid'";
        $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
    }
}

$profileName = $_POST['profileName'];
$sql = "UPDATE profileinfo 
        SET fullName = ?, facebookLink = ?, twitterLink = ?, instagramLink = ?, 
            treasurePointsPublic = ?, streakPublic = ?
        WHERE userID = '$userid'";
$update = $conn->prepare($sql);

$showTreasurePoints = isset($_POST['showTreasure']) ? 1 : 0;
$showStreak = isset($_POST['showStreak']) ? 1 : 0;

$update->bind_param('ssssii', $profileName, $_POST['linkFacebook'], 
                    $_POST['linkTwitter'], $_POST['linkInstagram'],
                    $showTreasurePoints, $showStreak);
$update->execute();

if ($profileName == trim($profileName)) {
    $sql2 = "UPDATE usernames
            SET fname = ?, lname = ?
            WHERE id = '$userid'";
    $update2 = $conn->prepare($sql2);
    
    $fullNameArray = explode(" ", $profileName);
    $fName = $fullNameArray[0];
    $lName = $fullNameArray[1];
    
    $update2->bind_param('ss', $fName, $lName);
    $update2->execute();
}
header('Location: profileView.php');
?>