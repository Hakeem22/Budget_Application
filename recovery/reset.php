<?php
include_once '../includes/dbconfig.php';
include_once 'message.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $activation = mysqli_real_escape_string($conn, $_POST['activation']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND email='$email' AND forgot_password='$activation'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $Results = mysqli_fetch_array($result);

    if ($count > 0) {

        $sql = "UPDATE users SET forgot_password=? WHERE username=?";

        $empty = "";
        $t = $conn->prepare($sql);
        $t->bind_param('si', $empty, $username);
        $t->execute();

        $username = ucfirst($username);

        $obj = new message();
        $obj->sendMail($email, "contact@insethium.com", "Insethium: Forgott Password", "Hi $username, <br><br>Everything has been processed through successfully, I would like to inform you that you will receive your new account password within the next 48 hours. <br> If you have any issues feel free to contact a staff member on our forums: www.insethium.com/forums  <br/> <br/>--<br>insethium.com<br>Insethium Account Recovery Support");
        $obj->sendMail("hakeems1996@gmail.com", "sigma@insethium.com", "Password Approveed" . $username, "Hi Sigma, <br><br>Can we process a password reset for the following username: $username the associated email address to the user is: $email <br><br> This user has successfully went through the forgotten password feature.  <br/> <br/>--<br>insethium.com<br>Insethium Account Recovery Support");

        echo "<center>Please read your emails in regards to your forgotten password. Please allow up to 48 hour for the email to arrive.</center><br>";
    } else {
        echo "<center>Please check the credentials to see if they are correct as they do not match our database. </center><br>";
    }

}

?>

<html>
<head>
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