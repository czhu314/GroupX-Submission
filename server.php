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
//isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the email and password fields!');
}
// REGISTER USER
if ($stmt = $con->prepare('SELECT password FROM usernames WHERE email = ?')) {
    //Username is a string so "s"
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header('Location: redirectLOGIN2.html');
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        
    }  else {
        header('Location: redirectLOGIN.html');
        require "pepper.php";
      
        $password = $_POST['password'] ;
        $email = $_POST['email'] ;
        $fname = $_POST['fname'] ;
        $lname = $_POST['lname'] ;
        $admincode = $_POST['code'] ;
        $typeuser = $_POST['typeuser'];
        $typeuser2 = $_POST['typeuser2'] ;
        $salt = bin2hex(openssl_random_pseudo_bytes(5));
        //send values to SQL database with a query
        //password will be mixed up and encripted with pepper and salt
        if ($typeuser == 'student'){
            //$cfg['PersistentConnections'] = TRUE; //apprently allows $findLast to work
            //$findLast = "SELECT id FROM usernames WHERE id=(SELECT max(id) FROM usernames)";  
           // $findNewLast = $findLast + 1; //the user currently registering
            $fullName = $fname . ' ' . $lname;
            $Total_Points='Total Points';
            $query = "INSERT INTO usernames ( password, salt, fname, lname, email, typeuser, admincode ) VALUES ('" . md5($password.$salt.pepper) . "', '$salt', '$fname', '$lname', '$email', '$typeuser', '0')";
            mysqli_query($con, $query);
            //getting the account id that was just submitted
    
            $query2 = "SELECT id FROM usernames WHERE email='$email'"; 
            $result = $con->query($query2);

            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $userid = $row['id'];
                }
        
        
            //creating an account profile view
        
            //append the two strings together
            $fullname .= "";
            $fullname .= $fname;
            $fullname .= " ";
            $fullname .= $lname;
        
            $email = $_POST['email'] ;
            $query3 = "INSERT INTO profileinfo (userID, fullName, email, treasureHuntPoints, streak, totalPointsPublic,           treasurePointsPublic, streakPublic) 
                   VALUES ('$userid', '$fullname', '$email','0','0','0','0','0')";
            mysqli_query($con, $query3);
            $queryL = "INSERT INTO leaderboard ( userid, name, subject, points )  VALUES ('$userid', '$fullName', '$Total_Points', '0')";
            mysqli_query($con, $queryL);
                
        }
            
        }else{
            if ($admincode == 12345) {
                header('Location: login.php');
                $query4 = "INSERT INTO usernames ( password, salt, fname, lname, email, typeuser, admincode ) VALUES ('" . md5($password.$salt.pepper) . "', '$salt', '$fname', '$lname', '$email', 'lecturer', '$admincode')";
                mysqli_query($con, $query4);
            }
            else {
                header('Location: redirectwrongCODE.html');
                echo "wrong code";
            }
        }

        //$find = "SELECT id FROM usernames where salt ='$salt',fname='$fname',lname='$lname',email='$email'"; 
        //$queryL = "INSERT INTO leaderboard ( userid, name, subject, points )  VALUES ('$find', '$fullName', '$Total_Points', '0')";
       // mysqli_query($con, $queryL);
        
        /**
        if ($typeuser == 'student'){
            $queryL = "INSERT INTO leaderboard userid, name, subject, points  VALUES '$findNewLast', '$fullName', '$Total_Points', '0'";
        }
        mysqli_query($con, $queryL);
        */
    
}
    
}

?>
