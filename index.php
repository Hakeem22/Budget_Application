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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Homepage</title>
</head>

<body>

<div id="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Customer Login</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>

                <li><a href="contact.php">Contact</a></li>

                <?php

                if (isset($_SESSION['login_user'])) {?>

                <li><a href="logout.php">Sign Out</a></li>

                <?php
                }?>

            </ul>
        </div>
    </nav>

    <form action="#" method="post">
        <?php
        if (!isset($_SESSION['login_user'])) {
            ?>

            <div class="form-group" align="center">
                <label for="inlineFormInputGroup">Username:</label>
                <input type="text" class="form-control"" name="username" id="username" style="width: 250px">
            </div>

            <div class="form-group" align="center">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="password" id="password" style="width: 250px">
            </div>

            <div class="form-check" align="center">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>

            <div class="buttons" align="center">
                <input type="submit" class="btn btn-primary" name="submit" value="Login">
                <input type="submit" class="btn btn-primary" name="passwordreset" value="Forgotten Password" onclick="window.open('./recovery')"><br><br>
            </div>

            <?php
            echo $errors;
        } else {
        ?>
        <h1>Heading</h1>
        <p class="test">Welcome back <b> <?php echo ucfirst($_SESSION['login_user'])  ?></b>, we have been waiting for your return. Please use the search bar below.</p>


        <input type="text" id="myInput" onkeyup="myFunction()" title="Type in a name">

        <ul id="myUL">
            <li><a href="#">Test</a></li>
            <li><a href="#">123</a></li>
            <li><a href="#">Hakeem</a></li>
            <?php
            }
            ?>
    </form>


</div>


<script>
    function myFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";

            }
        }
    }
</script>

</body>

</html>