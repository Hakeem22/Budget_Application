<?php
session_start();
include '../includes/dbconfig.php';
include '../classes/Email.php';

$message = '';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $statement = "SELECT * FROM users WHERE username=? AND email=?";

    $p = $conn->prepare($statement);
    $p->bind_param('ss', $username, $email);
    $p->execute();
    $count = $p->get_result()->num_rows;

    if ($count > 0) {
        $statement2 = "UPDATE users SET forgot_password=?, forgotten_date=? WHERE username=?";

        $encrypt = generateRandomString();
        $date = date("Y-m-d H:i:s");

        $t = $conn->prepare($statement2);
        $t->bind_param('sss', $encrypt, $date, $username);
        $t->execute();

        $username = ucfirst($username);

        $obj = new Email();
        $obj->sendMail($email, "contact@hakeemsuleman.co.uk", "Forgotten Password", "Hi $username, <br><br>Click the following link if you would like to reset your password: http://hakeemsuleman.co.uk/recovery/reset.php <br><br> Your retrieval code is: $encrypt <br>Please copy the retrieval code as this will be required on the next page.<br><br> Thanks,  <br/> <br>Account Recovery Support");

        $message = 'Please read your emails in regards to your forgotten password request.';
    } else {
        $message = 'The credentials entered does not match what is on our database. Please try again.';
    }

}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Forgotten Password</title>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href='../index.php'>Customer Login</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="../index.php">Home</a></li>

            <li><a href="../contact.php">Contact</a></li>

            <?php

            if (isset($_SESSION['login_user'])) {?>

                <li><a href="../logout.php">Sign Out</a></li>

                <?php
            } else { ?>

                <li class="active"><a href="../login.php">Sign In</a></li>
                <li><a href="../register.php">Sign up</a></li>

                <?php
            }
            ?>

        </ul>
    </div>
</nav>

<form action="" method="post">

    <?php if(!isset($_SESSION['login_user'])) { ?>
        <div class="form-group" align="center">
            <label for="inlineFormInputGroup">Username:</label>
            <input type="text" class="form-control" name="username" id="username" style="width: 250px">
        </div>

        <div class="form-group" align="center">
            <label for="inlineFormInputGroup">Email Address:</label>
            <input type="text" class="form-control" name="email" id="email" style="width: 250px">
        </div>

        <div class="buttons" align="center">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </div>

        <br>
        <div class="form-group" align="center">
            <label for="inlineFormInputGroup"><?php echo $message ?></label>
        </div>

        <?php
    }
    ?>

</form>

</body>

</html>