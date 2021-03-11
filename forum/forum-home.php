<?php
    include 'connect.php';

    if (isset($_GET['search-query'])) {
        $search_query = $_GET['search-query'];
        $search_forum = "SELECT * from Forums WHERE (forum_title LIKE '%$search_query%')";
        $search_results = $conn->query($search_forum);
        $testing_forums = "SELECT * from Forums WHERE (forum_title LIKE '%Computer%' or '%ECM%')";
        $testing_results = $conn->query($testing_forums);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums</title>
    <link rel="stylesheet" href="/forum/forum4.css" type="text/css" />
</head>

<body>

    <div class="main">

        <!-- navbar -->
        <div class="navbar">
            <div class="logo">
                <a class="a" style="text-decoration: none;" href="../../home.php">GROUP <span>X</span></a>
            </div>
            <ul>
                <li><a href="../app/profileView.php" id="cname">PROFILE</a></li>
                <li><a href="forum-home.php" id="cname">FORUM</a></li>
                <li><a href="../app/events.php" id="cname">EVENTS</a></li>
                <li><a href="../app/studentCodeRecieverNew.php" id="cname">GET POINTS</a></li>
                <li><a href="../logout.php" id="cname">LOG OUT</a></li>
            </ul>
        </div>

        <!-- title -->
        <div class="heading">
            <h2 class="head">University of Exeter <span>Forum</span></h2>
        </div>

        <div class="forum-container">

            <!-- search bar -->
            <div class="search">
                <form method="get">
                    <input type="text" autocomplete="off" name="search-query" placeholder="Search Forums">
                    <input type="submit" class="search-button" value="Search">
                </form>
            </div>


            <?php 
            if (isset($search_query)) {
            echo "<h3>Results from search '".$search_query."'.</h3>";
            while($post = $search_results->fetch_assoc()) {
                echo '<div class=forums>';
                echo '<form action="forum.php/" method="get">';
                echo '  <input type="submit" value="'.$post['forum_title'].'" class="forum-link">';
                echo '  <input type="hidden" value="'.$post['forum_id'].'" name="forum_id">';
                echo '</form>';    
                echo '</div>';
            } 
        
            } else { ?>
            <!--For You-->
            <h2>For You</h2>
            <?php 

        $get_forums_test = "SELECT * FROM Forums WHERE (forum_title LIKE '%Computer%' or forum_title LIKE '%ECM%')";
        $for_you_test = $conn->query($get_forums_test);

        while($forum = $for_you_test->fetch_assoc()) {
            echo '<div class="forums">';
            echo '<form action="forum.php/" method="get">';
            echo '  <input type="submit" value="'.$forum['forum_title'].'">';
            echo '  <input type="hidden" value="'.$forum['forum_id'].'" name="forum_id">';
            echo '</form>';
            echo '</div>';

        }
    ?>

            <!--get suggested forum names from database script here-->

            <!--Trending forums-->
            <h2>Trending</h2>
            <?php 

        $get_forums = "SELECT * FROM Forums;";
        $forums = $conn->query($get_forums);


        while($forum = $forums->fetch_assoc()) {
            echo '<div class="forums">';
            echo '<form action="forum.php/" method="get">';
            echo '  <input type="submit" value="'.$forum['forum_title'].'">';
            echo '  <input type="hidden" value="'.$forum['forum_id'].'" name="forum_id">';
            echo '</form>';
            echo '</div>';

        }
    ?>

            <!--get trending forums script here-->

            <?    }
        ?>

        </div>
    </div>
</body>

</html>