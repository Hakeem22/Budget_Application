<?php
include ('./classes/PasswordEncryption.php');
include ('./includes/dbconfig.php');

session_start();

$errors = array();
$returnMessage = "";

if (isset($_POST['loginButton'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $pe = new PasswordEncryption();
    $hash = $pe->getPassword($password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password='$hash'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $username;
        if (isset($_POST['rememberMe'])) {
            $year = time() + 31536000;
            setcookie('rememberMeCookie', $username, $year);
        } else {
            $past = time() - 3600;
            setcookie('rememberMeCookie', "", $past);
        }
    } else {
        $returnMessage = "<center>Please check your login credentials as they are invalid.</center>";
    }
}

if (isset($_POST['registerButton'])) {

    if (empty($_POST['user'])) {
        $errors[] = 'Please insert a username into the input field.';
    } else if (empty($_POST['pass'])) {
        $errors[] = 'Please enter a password into the input field.';
    } else if (empty($_POST['email'])) {
        $errors[] = 'Please enter a valid email address into the input field.';
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $pe = new PasswordEncryption();
        $hash = $pe->getPassword($password);

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        $sqlemail = "SELECT * FROM users WHERE email = '$email'";
        $result2 = mysqli_query($conn, $sqlemail);
        $counter = mysqli_num_rows($result2);

        if ($count > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another username.";
        } else if ($counter > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another email.";
        } else {
            $insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$hash', '$email')";
            mysqli_query($conn, $insert);
            $errors[] = "Your account has been successfully created please click <a href='index.php'>here</a> to login.";
        }
    }
}

mysqli_close($conn);

?>

<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

</html>
