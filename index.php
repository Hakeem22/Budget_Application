<?php
include 'header.php';
?>

<html>

<head>
    <title>Login</title>
    <script type="text/javascript">
        function onUse() {
            window.open('recovery');
        }
    </script>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href='./index.php'>Customer Login</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>

            <?php

            if (isset($_SESSION['login_user'])) {?>

                <li><a href="contact.php">Contact</a></li>
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

<?php
if (!isset($_SESSION['login_user'])) {
?>
<div class="login_container" style="height: 300px; width: 300px; margin: 0 auto; border-color: #e0d8d8; border-style: solid;">

    <form action="#" method="post">

        <h1 style="text-align: center">Customer Login</h1>
        <div class="form-group" align="center">
            <input type="text" class="form-control" name="email_address" placeholder="Email Address" style="width: 250px" value="<?php echo isset($_COOKIE['rememberMeCookie']) ? $_COOKIE['rememberMeCookie'] : ""; ?>">
        </div>

        <div class="form-group" align="center">
            <input type="password" class="form-control" name="password" placeholder="Password" style="width: 250px">
        </div>

        <div class="form-check" align="center">
            <input type="checkbox" class="form-check-input" name="rememberMe" <?php echo isset($_COOKIE['rememberMeCookie']) ? 'checked=checked' : ""; ?>>
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>

        <div class="buttons" align="center">
            <input type="submit" class="btn" name="loginButton" value="SIGN IN" style="width: 250px"><br>
            <input type="submit" class="btn border-0" name="passwordreset" value="FORGOTTEN PASSWORD?"  style="width: 250px" onclick="onUse()">
        </div>

        <?php
        echo $returnMessage;
        } else {
            ?>

            <?php
        }
        ?>
</div>
</form>

</div>

</body>

</html>