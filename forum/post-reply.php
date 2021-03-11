<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $forum_id = $_POST['forum_id'];
    $post_id = $_POST['post_id'];
    if ($_POST['anonymous'] == "true") {
        $user_id = 132;
    } else {
        $user_id = $_POST['user_id'];
    }
    $reply_content = $_POST['reply_content'];
}

    header("Location: /forum/view-post.php/?forum_id=".$forum_id."&post_id=".$post_id);
    include 'connect.php';



    $sql = "INSERT INTO Post_Replies (userID, postID, reply_content, time_posted)
    VALUES ('$user_id', '$post_id', '$reply_content', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    include 'close-connection.php';


?>