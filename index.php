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

                <li><a href="budget.php">Budget</a></li>
                <li><a href="profile.php">Profile</a></li>
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
<div class="login_container">

    <form action="#" method="post">

        <h1>Customer Login</h1>
        <div class="form-group" align="center">
            <input type="text" class="form-control" name="email_address" placeholder="Email Address" value="<?php echo isset($_COOKIE['rememberMeCookie']) ? $_COOKIE['rememberMeCookie'] : ""; ?>">
        </div>

        <div class="form-group" align="center">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        <div class="form-check" align="center">
            <input type="checkbox" class="form-check-input" name="rememberMe" <?php echo isset($_COOKIE['rememberMeCookie']) ? 'checked=checked' : ""; ?>>
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
        </div>

        <div class="buttons" align="center">
            <input type="submit" class="btn" name="loginButton" value="SIGN IN"><br>
            <input type="submit" class="btn border-0" name="passwordreset" value="FORGOTTEN PASSWORD?" onclick="onUse()">
        </div>
    </form>

        <?php
        echo $returnMessage;
        } else {
            ?>
            <h1 class="text-align-custom">Present Values</h1>
            <dl class="dl-horizontal text-align-custom">
                <?php
                $sql =  $conn->prepare("SELECT * FROM items WHERE email_address=?");
                $sql->bind_param("s", $_SESSION['login_user']);
                $sql->execute();
                $result = $sql->get_result();
                $spent = 0;
                while ($row = $result->fetch_assoc()) {
                    $spent += $row['item_amount']; ?>
                    <p><?php echo $row['item_name'] . ' : ' . $row['item_amount']; ?></p>
                <?php } ?>
                <p>MONTH TO DATE: £<?php echo $spent ?></p>
            </dl>
            <?php
        }
        ?>
</div>

</body>

</html>