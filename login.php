<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- Used to import the show/hide password eye-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>
<body>
    <form action="authenticate.php" method="post" >
        <div class="container">
            <h1>LOGIN</h1>
        <label for="email"><b>Email</b></label><br>
        <div class="email">
            <input type="text" placeholder="Enter Email" name="email" id="email" required>
        </div>
        <label for="password"><b>Password</b></label><br>
        <div class="pbox">
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
            <i class="fas fa-eye-slash" onClick="revealPwd(this)"> </i>
        </div>
        <input class="enter" type="submit" name="login" value="Login">
    </form>
    <a class="l1" href="index.html">Back</a>
</div>
<script>
    function revealPwd(element) {
        let x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            element.className = 'fas fa-eye'
        }
        else {
            x.type = "password";
            element.className = 'fas fa-eye-slash'
        }
    }
</script>
</body>
</html>