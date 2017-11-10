<?php
include ('./includes/dbconfig.php');
session_start();

$errors = "";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['login_user'] = $username;
    } else {
        $errors = "The credentials inserted are not correct, please try again.";
    }

}

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Homepage</title>
</head>

<body>

<div id="container">

    <div id="login_box">
        <center><form action="#" method="post">
                <?php
                if (!isset($_SESSION['login_user'])) {
                    ?>
                    <label>Username:</label><br>
                    <input type="text" name="username" id="username"><br>
                    <label>Password:</label><br>
                    <input type="password" name="password" id="password"><br>
                    <input type="submit" name="submit" value="Login">
                    <input type="submit" name="passwordreset" value="Forgotten Password" onclick="window.open('./recovery')"><br><br>
                    <?php
                    echo $errors;
                } else {
                ?>
                <h1>Heading</h1>
                <p class="test">Welcome back <b> <?php echo ucfirst($_SESSION['login_user'])  ?></b>, we have been waiting for your return. Please use the search bar below.</p>


                <input type="text" id="myInput" onkeyup="myFunction()" title="Type in a name">

                <ul id="myUL">
                    <li><a href="#">Test</a></li>
                    <li><a href="#">123</a></li>
                    <li><a href="#">Hakeem</a></li>
                    <?php
                    }
                    ?>
            </form></center>

    </div>

</div>


<script>
    function myFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";

            }
        }
    }
</script>
</body>

</html>