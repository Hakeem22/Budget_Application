<?php
include("./includes/dbconfig.php");
session_start();

$error = "Already a user? Click here to login.";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $sql = "SELECT UserID FROM users.users WHERE Username = '$username' and Password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        session_register("username");
        $_SESSION['login_user'] = $username;
        header("Location: index.php");
    } else {
        $error = "The credentials you have entered are invalid. Please try again.";
    }

}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Registration Page</title>
</head>

<body>
    <form action="" method="post">
        Username:<br>
        <input type="text" id="user" name="user" placeholder="Enter your username" required><br>
        Password:<br>
        <input type="password" id="pass" name="pass" placeholder="Enter your password" required><br>
        Email:<br>
        <input type="text" name="email" placeholder="Enter your email" required><br>
        <input type="submit" name="submit" value="Register">
    </form>

    <div id="message">
        <?php echo $error?>
    </div>
</body>

</html>