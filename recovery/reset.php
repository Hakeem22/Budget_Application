<?php
include '../includes/dbconfig.php';
include_once '../classes/Email.php';
include_once '../classes/PasswordEncryption.php';

$message = "";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $activation = mysqli_real_escape_string($conn, $_POST['activation']);

    $p = $conn->prepare( "SELECT * FROM users WHERE username=? AND email=? AND forgot_password=?");
    $p->bind_param('sss',$username,$email, $activation);
    $p->execute();
    $count = $p->get_result()->num_rows;

    if ($count > 0) {

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($myrow = $result->fetch_assoc()) {
            $da = strtotime(date("Y-m-d H:i:s"));
            $dd = strtotime($myrow['forgotten_date']);
            $results = ($da - $dd) / 60 % 60;

            if ($results > 59) {
                $message = "That retrieval code has expired. Please re-submit a new forgotten password request.";
            }
        }

        if (empty($message)) {
            $pe = new passwordEncryption();
            $password = $_POST['password'];
            $hash = $pe->getPassword($password);

            $t = $conn->prepare("UPDATE users SET forgot_password=?, password=? WHERE username=?");
            $t->bind_param('sss', $empty, $hash, $username);
            $t->execute();

            $username = ucfirst($username);

            $obj = new Email();
            $obj->sendMail($email, "contact@hakeemsuleman.co.uk", "Password Reset" . $username, "Hi $username, <br><br>  Your new password request has been submitted and accepted! <br/> <br/>Thanks,<br>Password Recovery Support");
            $message = 'Your new password submission has been accepted.';
        }

    } else {
        $message = 'Please check the credentials to see if they are correct as they do not match our database.';
    }

}

?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Password Recovery</title>
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
            <input type="text" class="form-control" name="username" style="width: 250px">
        </div>

        <div class="form-group" align="center">
            <label for="inlineFormInputGroup">Email Address:</label>
            <input type="text" class="form-control" name="email" style="width: 250px">
        </div>


        <div class="form-group" align="center">
            <label for="inlineFormInputGroup">Retrieval Code:</label>
            <input type="text" class="form-control" name="activation" style="width: 250px">
        </div>

        <div class="form-group" align="center">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password" style="width: 250px">
        </div>

        <div class="buttons" align="center">
            <input type="submit" class="btn btn-primary" name="submit" value="Recover">
        </div>

        <br>
        <div class="form-group" align="center">
            <label for="inlineFormInputGroup"><?php echo $message ?></label>
        </div>

        <?php
    } else {
        header( 'Location: index.php');
    }
    ?>

</form>

</body>

</html>