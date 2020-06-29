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

<form action="#" method="post">
    <?php
    if (!isset($_SESSION['login_user'])) {
        ?>

        <div class="form-group" align="center">
            <label for="inlineFormInputGroup">Email Address:</label>
            <input type="text" class="form-control" name="email_address"style="width: 250px" value="<?php echo isset($_COOKIE['rememberMeCookie']) ? $_COOKIE['rememberMeCookie'] : ""; ?>">
        </div>

        <div class="form-group" align="center">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password" style="width: 250px">
        </div>

        <div class="form-check" align="center">
            <input type="checkbox" class="form-check-input" name="rememberMe" <?php echo isset($_COOKIE['rememberMeCookie']) ? 'checked=checked' : ""; ?>>
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>

        <div class="buttons" align="center">
            <input type="submit" class="btn" name="loginButton" value="Login">
            <input type="submit" class="btn" name="passwordreset" value="Forgotten Password" onclick="onUse()"><br><br>
        </div>

        <?php
        echo $returnMessage;
    } else {
    ?>

        <p>You at present have %VARIABLE% tickets opened.</p>

        <?php
        }
        ?>
    </div>
</form>

</body>

</html>