<?php
include ('./includes/dbconfig.php');
session_start();

$errors = "";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $username;
    } else {
        $errors = "The credentials inserted are not correct, please try again.";
    }

}

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Homepage</title>
</head>

<body>

<div id="container">

    <div id="login_box">
        <center><form action="#" method="post">
            <?php
            if (!isset($_SESSION['login_user'])) {
                ?>
                <label>Username:</label><br>
                <input type="text" name="username" id="username"><br>
                <label>Password:</label><br>
                <input type="password" name="password" id="password"><br>
                <input type="submit" name="submit" value="Login">
                <input type="submit" name="passwordreset" value="Forgotten Password" onclick="window.open('./recovery')"><br><br>
                <?php
                echo $errors;
            } else {
                ?>
                <h1>Heading</h1>
                <p class="test">Welcome back <b> <?php echo ucfirst($_SESSION['login_user'])  ?></b>, we have been waiting for your return.</p>
                <input type="search"><br>
                <input type="submit" value="Submit">
                <?php
            }
            ?>
            </form></center>

    </div>

</div>

</body>

</html>