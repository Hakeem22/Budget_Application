<?php
include ('./includes/dbconfig.php');
session_start();

$returnMessage = "";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $salt1 = "qm8h*";
    $salt2 = "pg!@";

    $hash = hash("ripemd128", "$salt1$password$salt2");

    $sql = "SELECT * FROM users WHERE username = '$username' AND password='$hash'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $username;
        if (isset($_POST['rememberMe'])) {
            $year = time() + 31536000;
            setcookie('rememberMeCookie', $username, $year);
        } else {
            $past = time() - 3600;
            setcookie('rememberMeCookie', "", $past);
        }
    } else {
        $returnMessage = "<center>Please check your login credentials as they are invalid.</center>";
    }

}

?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Homepage</title>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href='./index.php'>Customer Login</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>

            <li><a href="contact.php">Contact</a></li>

            <?php

            if (isset($_SESSION['login_user'])) {?>

                <li><a href="logout.php">Sign Out</a></li>

                <?php
            } else { ?>

                <li class="active"><a href="login.php">Sign In</a></li>
                <li><a href="register.php">Sign up</a></li>

                <?php
            }
            ?>

        </ul>
    </div>
</nav>

<form action="#" method="post">
    <?php
    if (!isset($_SESSION['login_user'])) {
        ?>

        <div class="form-group" align="center">
            <label for="inlineFormInputGroup">Username:</label>
            <input type="text" class="form-control" name="username" id="username" style="width: 250px" value="<?php echo isset($_COOKIE['rememberMeCookie']) ? $_COOKIE['rememberMeCookie'] : ""; ?>">
        </div>

        <div class="form-group" align="center">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password" id="password" style="width: 250px">
        </div>

        <div class="form-check" align="center">
            <input type="checkbox" class="form-check-input" name="rememberMe" <?php echo isset($_COOKIE['rememberMeCookie']) ? 'checked=checked' : ""; ?>>
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>

        <div class="buttons" align="center">
            <input type="submit" class="btn btn-primary" name="submit" value="Login">
            <input type="submit" class="btn btn-primary" name="passwordreset" value="Forgotten Password" onclick="window.open('./recovery')"><br><br>
        </div>

        <?php
        echo $returnMessage;
    } else {
    ?>

        <?php header( 'Location: http://localhost/Registration_site/index.php' ) ; ?>

        <?php
        }
        ?>
    </div>
</form>

</body>

</html>