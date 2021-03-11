<?php
    header("Location: /forum/forum.php/?forum_id=".$_POST['forum_id']);
    include 'connect.php';

    if ( !isset($_POST['post-title'], $_POST['post-content']) ) {
        // Could not get the data that should have been sent.
        exit('Please fill both fields.');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = $_POST['userID'];
        $forum_id = $_POST['forum_id'];
        $title = $_POST['post-title'];
        $content = $_POST['post-content'];
    }



    $sql = "INSERT INTO Forum_Posts (userID, forum_id, post_title, post_content, likes, time_posted) 
    VALUES ('$userID', '$forum_id', '$title' , '$content', 0, NOW())";
    //mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    include 'close-connection.php';

?>