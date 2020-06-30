<?php
include 'header.php';
?>

<html>

<head>
    <title>Contact Us</title>
</head>

<body>

<div id="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href='./index.php'>Customer Login</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>

                <li class="active"><a href="contact.php">Contact</a></li>

                <?php

                if (isset($_SESSION['login_user'])) {?>

                    <li><a href="logout.php">Sign Out</a></li>

                    <?php
                } else { ?>

                    <li><a href="register.php">Sign up</a></li>

                    <?php
                }
                ?>

            </ul>
        </div>
    </nav>

    <form method="post" action="classes/Email.php">
        <div class="form-group" align="center">
            <label for="formGroupExampleInput">Full Name:</label>
            <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Enter Your Full Name">
        </div>
        <div class="form-group" align="center">
            <label for="exampleInputEmail1">Email address:</label>
            <input type="email" class="form-control" name="emailAddress" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email Address">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group" align="center">
            <label for="formGroupExampleInput">Contact Number:</label>
            <input type="text" class="form-control" name="cnumber" id="mobileNumber" placeholder="Enter Contact Number">
        </div>
        <div class="form-group" align="center">
            <label for="formGroupExampleInput">Subject:</label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject">
        </div>
        <div class="form-group" align="center">
            <label for="formGroupExampleInput">What can we help you with?</label>
            <textarea class="form-control" type="textarea" name="ctext" id="message" placeholder="Enter Your Message" style="width: 500px; height: 100px;"></textarea>
        </div>
        <center><button type="submit" class="btn btn-primary">Submit</button></center>
    </form>

</div>

</body>

</html>