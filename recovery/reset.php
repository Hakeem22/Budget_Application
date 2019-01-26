<?php
include '../includes/dbconfig.php';
include_once '../classes/emailhandler.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $activation = mysqli_real_escape_string($conn, $_POST['activation']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND email='$email' AND forgot_password='$activation'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $Results = mysqli_fetch_array($result);

    if ($count > 0) {

        $sql = "UPDATE users SET forgot_password=?, password=? WHERE username=?";

        $empty = "";
        $newpass = "tes321t";
        $t = $conn->prepare($sql);
        $t->bind_param('sss', $empty, $newpass, $username);
        $t->execute();

        $username = ucfirst($username);

        $obj = new emailhandler();
        $obj->sendMail($email, "sigma@insethium.com", "Password Reset" . $username, "Hi $username, <br><br> Your brand new password that has been generated is: $newpass <br/> <br/>--<br>insethium.com<br>Insethium Account Recovery Support");

        echo "<center>Please read your emails in regards to your forgotten password. Please allow up to 48 hour for the email to arrive.</center><br>";
    } else {
        echo "<center>Please check the credentials to see if they are correct as they do not match our database. </center><br>";
    }

}

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Insethium Account Recovery</title>
</head>

<body>
<center>
    <form action="" method="post">
        Please enter your in-game username:<br>
        <input type="text" name="username"><br>
        Please enter your email associated to the username:<br>
        <input type="email" name="email"><br>
        Please enter your retrieval code that was provided on the email:<br>
        <input type="text" name="activation">
        <br><input type="submit" name="submit" value="Recover">
    </form>
</center>

</body>

</html>