<?php
    include 'connect.php';

	$post_id = $_GET['post_id'];
    $forum_id = $_GET['forum_id'];

	$get_post = "SELECT * FROM Forum_Posts WHERE postID='$post_id'";
	$post = $conn->query($get_post);

	$get_replies = "SELECT * FROM Post_Replies WHERE postID='$post_id' ORDER BY replyID DESC";
	$replies = $conn->query($get_replies);
    $num_replies = mysqli_num_rows($replies);


    $email = $_SESSION['name'];
    $sql = "SELECT * FROM usernames WHERE email = '$email'";
    $user_data = $conn->query($sql);

    while ($user = $user_data->fetch_assoc()) {
        $user_id = $user['id'];
    }

    $check_liked_query = "SELECT * FROM User_Likes where user_id = '$user_id' AND post_id = '$post_id'";
    $check_liked = $conn->query($check_liked_query);

    if (mysqli_num_rows($check_liked)==0) {
        $liked = false;
    } else {
        $liked = true;
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

                    <!-- return to forum -->
                    <form action="/forum/forum.php/" method="get">
                        <input type="hidden" name="forum_id" value="<? echo $forum_id ?>">
                        <input type="submit" class="back-button" value="< Back">
                    </form>
                    <!-- post a reply -->
                    <h4>Post a Reply</h4>
                    <div class="write-reply">
                        <form action="/forum/post-reply.php" method="post">
                            <textarea name="reply_content" cols="30" rows="5"></textarea><br>
                            <input type="hidden" name="post_id" value="<? echo $post_id ?>">
                            <input type="hidden" name="user_id" value="<? echo $user_id ?>">
                            <input type="hidden" name="forum_id" value="<? echo $forum_id ?>">
                            <label for="anonymous">Post as Anonymous</label>
                            <input type="checkbox" name="anonymous" value="true"><br>
                            <input type="submit" class="small-button" value="Reply">
                        </form>
                    </div>
                </div>



                <!-- show title post -->
                <? while($title_post = $post->fetch_assoc()) { 
                $id = $title_post['userID'];
                $sql = "SELECT fname, lname FROM usernames WHERE id = '$id'";
                $user_data = $conn->query($sql);
                $profile_view = "../../app/profileView.php?user_id=$id"?>
                <div class="forum-post">
                    <div class="user-profile-forum">
                        <!--user profile picture and name-->
                        <!--<img class="forum-profile-photo" src="/profile-picture-test.png"><br>-->
                        <? while($user = $user_data->fetch_assoc()) { ?>
                        <p class="forum-user-name">By <a class="forum-link-to-user"
                                href=<?echo $profile_view?>>
                                <? echo $user['fname']; echo " "; echo $user['lname']; ?>
                            </a></p>
                        <? } ?>
                        <p class="forum-user-name">Posted:
                            <? echo $title_post['time_posted'] ?>
                        </p>

                        <? if ($liked == true) { ?>
                        <form action="/forum/unlike-post.php" method="post">
                            <input type="hidden" name="post_id" value="<? echo $post_id ?>">
                            <input type="hidden" name="forum_id" value="<? echo $forum_id ?>">
                            <input type="submit" class="unlike-button" value="&#9829; Unlike Post">
                        </form>
                        <? } else { ?>
                        <form action="/forum/like-post.php" method="post">
                            <input type="hidden" name="post_id" value="<? echo $post_id ?>">
                            <input type="hidden" name="forum_id" value="<? echo $forum_id ?>">
                            <input type="submit" class="like-button" value="&#9829; Like Post">
                        </form>

                        <? } ?>

                    </div>
                    <div class="forum-preview">
                        <!--title/subject-->
                        <h4 class="post-title">
                            <? echo $title_post['post_title'] ?>
                        </h4>
                        <!--preview of post? first line?-->
                        <p class="content-preview">
                            <? echo $title_post['post_content'] ?>
                        </p>
                        <!--also show number of likes-->
                    </div>

                </div>
                <?php }  ?>

            </div>

            <h4>Replies (<? echo $num_replies ?>)</h4>

            <div class="posts">
                <? while($reply = $replies->fetch_assoc()) { 
                    $id = $reply['userID'];
                    $sql = "SELECT fname, lname FROM usernames WHERE id = '$id'";
                    $user_data = $conn->query($sql);
                    $profile_view = "../../app/profileView.php?user_id=$id"?>

                <div class="forum-reply">
                    <? while($user = $user_data->fetch_assoc()) { ?>
                        <p class="forum-user-name">By <a class="forum-link-to-user"
                        href=<? echo $profile_view?>>
                        <? echo $user['fname']; echo " "; echo $user['lname']; ?>
                        </a>
                    <? } ?>
                        • <? echo $reply['time_posted'] ?>
                    </p>
                    <p>
                        <? echo $reply['reply_content'] ?>
                    </p>
                </div>

                <? } ?>
            </div>
        </div>
    </div>


</body>

</html>