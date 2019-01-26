<?php
include("./includes/dbconfig.php");

session_start();

$errors = array();

if (isset($_POST['submit'])) {

    if (empty($_POST['user'])) {
        $errors[] = 'Please insert a username into the input field.';
    } else if (empty($_POST['pass'])) {
        $errors[] = 'Please enter a password into the input field.';
    } else if (empty($_POST['email'])) {
        $errors[] = 'Please enter a valid email address into the input field.';
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $salt1 = "qm8h*";
        $salt2 = "pg!@";

        $hash = hash("ripemd128", "$salt1$password$salt2");

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        $sqlemail = "SELECT * FROM users WHERE email = '$email'";
        $result2 = mysqli_query($conn, $sqlemail);
        $counter = mysqli_num_rows($result2);

        if ($count > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another username.";
        } else if ($counter > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another email.";
        } else {
            $insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$hash', '$email')";
            mysqli_query($conn, $insert);
            $errors[] = "Your account has been successfully created please click <a href='index.php'>here</a> to login.";
        }
    }
}

mysqli_close($conn);

?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registration Page</title>
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

                <?php header( 'Location: http://localhost/Registration_site/index.php' ) ; ?>

                <?php
            } else { ?>

                <li><a href="login.php">Sign In</a></li>
                <li class="active"><a href="register.php">Sign up</a></li>

                <?php
            }
            ?>

        </ul>
    </div>
</nav>

<div id="login_box" align="center">
    <form action="" method="post">

        <div class="form-group">
            <label for="inlineFormInputGroup">Username:</label>
            <input type="text" class="form-control"" name="user" style="width: 250px">
        </div>

        <div class="form-group">
            <label for="inlineFormInputGroup">Password:</label>
            <input type="password" class="form-control" name="pass" style="width: 250px">
        </div>

        <div class="form-group">
            <label for="inlineFormInputGroup">Email Address:</label>
            <input type="text" class="form-control" name="email" style="width: 250px">
        </div>

        <div class="buttons">
            <input type="submit" class="btn btn-primary" name="submit" value="Sign up">
        </div>
    </form>

</div>

<div id="message">
    <?php
    foreach ($errors as $key => $values) {
        echo '<br><center>' . $values . ' </center>';
    }
    ?>
</div>

</body>

</html>