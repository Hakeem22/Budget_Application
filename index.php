<?php
include ('./includes/dbconfig.php');
session_start();

$errors = array();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users.users WHERE username = '$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $username;
        echo '??worksfine';
    } else {
        echo '?';
    }

}
if (isset($_SESSION['login_user'])) {
    echo '<br>worked fine as well';
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
        <?php
        if (!isset($_SESSION['login_user'])) {
            ?>
            Username:<br>
            <input type="text" name="username" id="username"><br>
            Password:<br>
            <input type="password" name="password" id="password"><br>
            <input type="submit" name="submit" value="Login">
            <input type="submit" name="passwordreset" value="Forgot Password?">
            <?php
        }
        ?>
    </form>
</div>

</body>

</html>