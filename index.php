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
            <dl class="dl-horizontal text-align-custom">

                <table class="table custom_table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Cost</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                <?php
                $sql =  $conn->prepare("SELECT * FROM items WHERE email_address=?");
                $sql->bind_param("s", $_SESSION['login_user']);
                $sql->execute();
                $result = $sql->get_result();
                $spent = 0;
                while ($row = $result->fetch_assoc()) {
                    $spent += $row['item_amount'];
                    $date = strtotime($row['date']);
                    $format_date = date('d-m-Y', $date);?>
                        <tbody>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['item_name']; ?></td>
                            <td>£<?php echo $row['item_amount']; ?></td>
                            <td><?php echo $format_date ?></td>
                            <td><a href="index.php">Delete</a></td>
                        </tr>
                        </tbody>
                <?php } ?>
            </dl>
            </table>
            <br><p>MONTH TO DATE: £<?php echo $spent ?></p>
            <?php
        }
        ?>
</div>

</body>

</html>