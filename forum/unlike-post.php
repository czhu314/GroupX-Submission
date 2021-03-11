<?php

    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $postID = $_POST['post_id'];
        $forumID = $_POST['forum_id'];
    }

    $email = $_SESSION['name'];
    $get_id = "SELECT * FROM usernames WHERE email = '$email'";
    $user_data = $conn->query($get_id);

    while ($user = $user_data->fetch_assoc()) {
        $user_id = $user['id'];
    }

    header("Location: /forum/view-post.php/?forum_id=".$forumID."&post_id=".$postID);


    $unlike_post = "DELETE FROM User_Likes 
    WHERE user_id ='$user_id' AND post_id = '$postID' ";
    $unliked = $conn->query($unlike_post);

    $sql = "UPDATE Forum_Posts
    SET likes = (likes - 1)
    WHERE postID = '$postID'";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

include 'close-connection.php';

?>