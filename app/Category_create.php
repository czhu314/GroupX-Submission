<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a Category</title>
</head>
<body>
<form action="categoryCreateDb.php" method="post">
    Category name:
    <input type="text" placeholder="Enter Category" name="cname" id="cname" required="true" >
    <p>
        3 character code: <input type="text" placeholder="Enter Category" name="charcode" id="charcode"  maxlength="3" minlength="3" required="true">
    <p>
        Generate A Forum About this subject<input type="checkbox" placeholder="Enter Category" name="CName" id="makeforum">
    <p>
        <input class="enter" type="submit" name="login" value="Create Category">
</form>

<script>
    window.onload = function() {
        var error = document.sessionStorage["error"];
     window.alert(error);
    };
</script>

</body>
</html>