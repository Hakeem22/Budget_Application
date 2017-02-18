<?php
include("./includes/dbconfig.php");
session_start();

$errors = array();

if (isset($_POST['submit'])) {
    if (empty($_POST['user'])) {
        $errors[] = 'Please insert a username into the input field.';
    }
    if (empty($_POST['pass'])) {
        $errors[] = 'Please enter a password into the input field.';
    }
    if (empty($_POST['email'])) {
        $errors[] = 'Please enter a valid email address into the input field.';
    }

    if (empty($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['user']);//create it so it checks emails as well
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "SELECT * FROM users.users WHERE Username = '$username'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $errors[] = "The credentials you have entered have been used already. Please try with another username.";
        } else {
            $insert = "INSERT INTO users.users (Username, Password, EmailAddress) VALUES ('$username', '$password', '$email')";
            mysqli_query($conn, $insert);
            $errors[] = "The credentials have not been used previously therefore your account has been created try to login <a href='login.php'>here</a>";//register user here
        }
    }

}

mysqli_close($conn);

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registration Page</title>
</head>

<body>
    <form action="" method="post">
        Username:<br>
        <input type="text" id="user" name="user" placeholder="Enter your username"><br>
        Password:<br>
        <input type="password" id="pass" name="pass" placeholder="Enter your password"><br>
        Email:<br>
        <input type="text" name="email" placeholder="Enter your email"><br>
        <input type="submit" name="submit" value="Register">
    </form>

    <div id="message">
        <?php
        foreach ($errors as $key => $values) {
            echo '<br>' . $values;
        }
        ?>
    </div>
</body>

</html>