<?php
include ('includes/dbconfig.php');
session_start();

$errors = array();

if (isset($_POST['submit']) || isset($_SESSION['login_user'])) {
    echo "testing";
}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Homepage</title>
</head>

<body>

<div id="login_box">
    <form action="#" method="post">
        Username:<br>
        <input type="text" name="username" id="username"><br>
        Password:<br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" name="submit" value="Login">
        <input type="submit" name="passwordreset" value="Forgot Password?">
    </form>
</div>


</body>

</html>