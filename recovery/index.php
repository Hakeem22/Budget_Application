<?php
session_start();
include '../includes/dbconfig.php';
include 'message.php';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND email='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $Results = mysqli_fetch_array($result);

    if ($count > 0) {
        $encrypt = generateRandomString();

        $sqls = "UPDATE users SET forgot_password=? WHERE username=?";

        $t = $conn->prepare($sqls);
        $t->bind_param('ss', $encrypt, $username);
        $t->execute();

        $username = ucfirst($username);

        $obj = new message();
        $obj->sendMail($email, "contact@insethium.com", "Insethium: Forgotten Password", "Hi $username, <br><br>Click the following link if you would like to reset your password: http://insethium.com/recovery/reset.php <br><br> Your retrieval code is: $encrypt <br>Please copy the retrieval code as this will be required on the next page.<br><br> Thanks,  <br/> <br>Insethium Account Recovery Support");

        echo "<center>Please read your emails in regards to your forgotten password. Please allow upto 1 hour for the email to arrive.</center><br>";
    } else {
        echo "<center>It seems that the credentials inserted are incorrect. </center><br>";
    }

}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Insethium Account Recovery</title>
</head>

<body>
<center>
    <?php
    if (!isset($_SESSION['login_user'])) {
        ?>
        <form action="" method="post">
            Please enter your username:<br>
            <input type="text" name="username"><br>
            Please enter your email associated to the username:<br>
            <input type="email" name="email">
            <br><input type="submit" name="submit" value="Recover">
        </form>
        <?php
    }
    ?>
</center>

</body>

</html>