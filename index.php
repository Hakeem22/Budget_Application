<?php
include 'header.php';
?>

<html>

<head>
    <title>Homepage</title>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href='./index.php'>Customer Login</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>

            <li><a href="contact.php">Contact</a></li>

            <?php

            if (isset($_SESSION['login_user'])) {?>

                <li><a href="logout.php">Sign Out</a></li>

                <?php
            } else { ?>

                <li><a href="login.php">Sign In</a></li>
                <li><a href="register.php">Sign up</a></li>

                <?php
            }
            ?>

        </ul>
    </div>
</nav>

</body>

</html>