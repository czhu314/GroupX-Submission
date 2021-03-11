<?php
    include 'connect.php';
    $forum_id = $_POST['forum_id'];
    //echo $forum_id;
    $email = $_SESSION['name'];
    $sql = "SELECT id, fname FROM usernames WHERE email = '$email'";
    $user_data = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="/forum/forum4.css" type="text/css"/>
</head>

<body>

<div class="main">
    <div class="overlay"></div>

    <!-- navbar -->
        <div class="navbar">
            <div class="logo">
                <a class="a" style="text-decoration: none;" href="../../home.php">GROUP <span>X</span></a>
            </div>
            <ul>
                <li><a href="../../app/profileView.php" id="cname">PROFILE</a></li>
                <li><a href="../forum-home.php" id="cname">FORUM</a></li>
                <li><a href="../../app/events.php" id="cname">EVENTS</a></li>
                <li><a href="../../app/studentCodeRecieverNew.php" id="cname">GET POINTS</a></li>
                <li><a href="../../logout.php" id="cname">LOG OUT</a></li>
            </ul>
        </div>

        <!-- title -->
        <div class="heading">
            <h2 class="head">University of Exeter <span>Forum</span></h2>
        </div>

    <div class="forum-container">

    <h1>Add Post</h1>
    <div class=add-post>
        <form id="add-post" autocomplete="off" method="post" action="/forum/add-post-to-db.php">
            <input type="hidden" name="forum_id" value=" <?echo $forum_id ?> ">
            <? while($user = $user_data->fetch_assoc()) { ?>
                <input type="hidden" name="userID" value="<? echo $user['id'] ?>">
            <? }
            ?>
            <label>Topic</label>
            <input type="text" class="forum-post-title" name="post-title">
            <textarea rows=10 form="add-post" name="post-content"></textarea>
            <input type="submit" value="Add Post" class="small-button">
        </form>
    </div>
    <?php

        //echo $forum_id;
    ?>

</div>

</body>
</html>
