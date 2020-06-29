<?php
include 'header.php';
?>

<html>

<head>
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

            <?php

            if (isset($_SESSION['login_user'])) {?>

                <?php header( 'Location: /index.php' ) ; ?>

                <?php
            } else { ?>

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
            <label for="inlineFormInputGroup">First Name:</label>
            <input type="text" class="form-control" name="fname" style="width: 250px">
        </div>

        <div class="form-group">
            <label for="inlineFormInputGroup">Second Name:</label>
            <input type="text" class="form-control" name="sname" style="width: 250px">
        </div>

        <div class="form-group">
            <label for="inlineFormInputGroup">Email Address:</label>
            <input type="text" class="form-control" name="email" style="width: 250px">
        </div>

        <div class="form-group">
            <label for="inlineFormInputGroup">Mobile Number:</label>
            <input type="text" class="form-control" name="mobile" style="width: 250px">
        </div>

        <div class="form-group">
            <label for="inlineFormInputGroup">Password:</label>
            <input type="password" class="form-control" name="pass" style="width: 250px">
        </div>

        <div class="buttons">
            <input type="submit" class="btn" name="registerButton" value="Sign up">
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