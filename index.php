<?php
include ('./includes/dbconfig.php');
session_start();

$errors = array();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $username;
    } else {
        $errors = array("The information you have inserted is incorrect.", "Did you know the password and username is case-sensitive.", "If it still does not work feel free to use the forgotten password feature nearby login.");
    }

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
            <label>Username:</label><br>
            <input type="text" name="username" id="username"><br>
            <label>Password:</label><br>
            <input type="password" name="password" id="password"><br>
            <input type="submit" name="submit" value="Login">
            <input type="submit" name="passwordreset" value="Forgotten Password" onclick="window.open('./forgot.php')"><br><br>
            <?php
            foreach($errors as $key => $errors) {
                echo "Login failed: " . $errors . "<br>";
            }
        } else {
            ?>
            <h1>Heading</h1>
            <p class="test">Welcome back to the website <?php echo $_SESSION['login_user']; ?>, we have been waiting for your return.</p>
            <?php
        }
        ?>
    </form>
</div>

</body>

</html>