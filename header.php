<?php
include ('./classes/PasswordEncryption.php');
include ('./includes/dbconfig.php');

session_start();

$errors = array();
$returnMessage = "";

if (isset($_POST['loginButton'])) {
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $pe = new PasswordEncryption();
    $hash = $pe->getPassword($password);

    $sql = "SELECT * FROM users WHERE email_address='$email_address' AND password='$hash'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $email_address;
        if (isset($_POST['rememberMe'])) {
            $year = time() + 31536000;
            setcookie('rememberMeCookie', $email_address, $year);
        } else {
            $past = time() - 3600;
            setcookie('rememberMeCookie', "", $past);
        }
    } else {
        $returnMessage = "<center>Please check your login credentials as they are invalid.</center>";
    }
}

if (isset($_POST['registerButton'])) {

    if (empty($_POST['fname'])) {
        $errors[] = 'Please insert a first anme into the input field.';
    } else if (empty($_POST['sname'])) {
        $errors[] = 'Please enter a second name into the input field.';
    } else if (empty($_POST['mobile'])) {
        $errors[] = 'Please enter a mobile number into the input field.';
    } else if (empty($_POST['pass'])) {
        $errors[] = 'Please enter a password into the input field.';
    } else if (empty($_POST['email'])) {
        $errors[] = 'Please enter a valid email address into the input field.';
    }

    if (empty($errors)) {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $sname = mysqli_real_escape_string($conn, $_POST['sname']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $pe = new PasswordEncryption();
        $hash = $pe->getPassword($password);

        $sql = "SELECT * FROM users WHERE mobile_number='$mobile'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        $sqlemail = "SELECT * FROM users WHERE email_address='$email'";
        $result2 = mysqli_query($conn, $sqlemail);
        $counter = mysqli_num_rows($result2);

        if ($count > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another mobile number..";
        } else if ($counter > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another email address.";
        } else {
            $insert = "INSERT INTO users (first_name, second_name, password, email_address, mobile_number) VALUES ('$fname', '$sname', '$hash', '$email', '$mobile')";
            mysqli_query($conn, $insert);
            $errors[] = "Your account has been successfully created please click <a href='index.php'>here</a> to login.";
        }
    }
    mysqli_close($conn);
}

?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

</html>
