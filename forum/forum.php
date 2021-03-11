<?php 
    include 'connect.php';

    $forum_id = $_GET['forum_id'];

    if (isset($_GET['sort'])) {
        if ($_GET['sort'] == "new") {
            $get_posts = "SELECT * FROM Forum_Posts WHERE forum_id='$forum_id' ORDER BY postID DESC";

        }
        else if ($_GET['sort'] == "old") {
            $get_posts = "SELECT * FROM Forum_Posts WHERE forum_id='$forum_id' ORDER BY postID ASC";

        }
        else if ($_GET['sort'] == "top") {
            $get_posts = "SELECT * FROM Forum_Posts WHERE forum_id='$forum_id' ORDER BY likes DESC";

        }
    }
    else {
        $get_posts = "SELECT * FROM Forum_Posts WHERE forum_id='$forum_id' ORDER BY postID DESC";
    }
    
    // $get_posts = "SELECT * FROM Forum_Posts WHERE forum_id='$forum_id' ORDER BY postID DESC";
    $posts = $conn->query($get_posts);

    $get_forum_title = "SELECT * FROM Forums WHERE forum_id='$forum_id'";
    $title = $conn->query($get_forum_title);

    $email = $_SESSION['name'];


    if (isset($_GET['search-query'])) {
        $search_query = $_GET['search-query'];
        $search_forum = "SELECT * from Forum_Posts WHERE forum_id='$forum_id' AND (post_title LIKE '%$search_query%' OR post_content LIKE '%$search_query%')";
        $search_results = $conn->query($search_forum);
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
            <div class="sideways">

                <div class="forum-top">

                    <!-- back to forum home -->
                    <form action="/forum/forum-home.php">
                        <input type="submit" class="back-button" value="< Back">
                    </form>

                    <!--get title of forum from database-->
                    <? $result = $title->fetch_assoc() ?>
                    <h1>
                        <? echo $result['forum_title'] ?>
                    </h1>


                    <!--add new post-->
                    <div class="new-post">
                        <form action="/forum/add-post.php" method="post">
                            <input type="hidden" name="forum_id" value="<? echo $forum_id ?>">
                            <input type="submit" value="+ New Post" class="button">
                        </form>
                    </div>

                    <!--sort posts-->
                    <label for="sort-posts">Sort Posts By</label>

                    <form action="/forum/forum.php" method="get">
                        <select name="sort" id="sort-posts">
                            <option value="new">NEW</option>
                            <option value="old">OLD</option>
                            <option value="top">TOP</option>
                        </select>
                        <input type="hidden" name="forum_id" value="<? echo $forum_id ?>">
                        <input type="submit" class="small-button" value="Sort">
                    </form>


                    <!--search forum-->
                    <div class="search">
                        <form method="get">
                            <input type="hidden" value="<? echo $forum_id ?>" name="forum_id">
                            <input class="searchbar" type="text" autocomplete="off" name="search-query"
                                placeholder="Search Forum">
                            <input type="submit" class="small-button" value="Search">
                        </form>
                    </div>

                </div>
                <!--posts-->
                <div class="posts">

                    <?php

    if (isset($search_query)) {
        echo "<h3>Results from search '".$search_query."'.</h3>";
        while($post = $search_results->fetch_assoc()) { 
            $id = $post['userID'];
            $sql = "SELECT fname, lname FROM usernames WHERE id = '$id'";
            $user_data = $conn->query($sql); 
            $profile_link = "../../app/profileView.php?user_id=$id";?>
                    <div class="forum-post">

                        <div class="user-profile-forum">
                            <!--user profile picture and name-->
                            <!--<img class="forum-profile-photo" src="/profile-picture-test.png"><br>-->
                            <? while($user = $user_data->fetch_assoc()) { ?>
                            <p class="forum-user-name">By <a class="forum-link-to-user" href=<? echo $profile_link?>>
                                    <? echo $user['fname']; echo " "; echo $user['lname']; ?>
                                </a></p>
                            <? }
                        ?>

                            <p class="forum-user-name">Posted:
                                <? echo $post['time_posted'] ?>
                            </p>

                            <form action="/forum/view-post.php/" method="get">
                                <input type="submit" class="small-button" value="View Post and Replies">
                                <input type="hidden" name="forum_id" value=<? echo $post['forum_id'] ?>>
                                <input type="hidden" name="post_id" value=<? echo $post['postID'] ?>>
                            </form>

                        </div>
                        <div class="forum-preview">
                            <!--title/subject-->
                            <h4 class="post-title">
                                <? echo $post['post_title'] ?>
                            </h4>
                            <!--preview of post? first line?-->
                            <p class="content-preview">
                                <? echo $post['post_content'] ?>
                            </p>
                            <!--also show number of likes-->
                        </div><br>
                        <p class="likes">&#9829;
                            <? echo $post['likes'] ?> &#x1F5E8;
                            <? echo $no_replies ?>
                        </p>
                    </div>
                    <? }
    } else {
        while($post = $posts->fetch_assoc()) { 
            $id = $post['userID'];
            $sql = "SELECT fname, lname FROM usernames WHERE id = '$id'";
            $user_data = $conn->query($sql);
            $this_post_id = $post['post_id']; 
            $replies = "SELECT * FROM Forum.Post_Replies WHERE postID='$this_post_id' ORDER BY replyID DESC"; 
            $no_replies = $replies->num_rows; 
            $profile_link = "../../app/profileView.php?user_id=$id"?>
                    <div class="forum-post">

                        <div class="user-profile-forum">
                            <!--user profile picture and name-->
                            <!--<img class="forum-profile-photo" src="/profile-picture-test.png"><br>-->
                            <? while($user = $user_data->fetch_assoc()) { ?>
                            <p class="forum-user-name">By <a class="forum-link-to-user" href=<? echo $profile_link?>>
                                    <? echo $user['fname']; echo " "; echo $user['lname']; ?>
                                </a></p>
                            <? }
                        ?>
                            <p class="forum-user-name">Posted:
                                <? echo $post['time_posted'] ?>
                            </p>

                            <form action="/forum/view-post.php/" method="get">
                                <input type="submit" class="small-button" value="View Post and Replies">
                                <input type="hidden" name="forum_id" value=<? echo $post['forum_id'] ?>>
                                <input type="hidden" name="post_id" value=<? echo $post['postID'] ?>>
                            </form>

                        </div>
                        <div class="forum-preview">
                            <!--title/subject-->
                            <h4 class="post-title">
                                <? echo $post['post_title'] ?>
                            </h4>
                            <!--preview of post? first line?-->
                            <p class="content-preview">
                                <? echo $post['post_content'] ?>
                            </p>
                            <!--also show number of likes-->
                        </div><br>
                        <p class="likes">&#9829;
                            <? echo $post['likes'] ?> &#x1F5E8;
                            <? echo $no_replies ?>
                        </p>
                    </div>
                    <? } }?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>