<?php
include 'header.php';
?>

<html>

<head>
    <title>Budget Page</title>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href='./index.php'>Customer Login</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION['login_user'])) {?>

                <li class="active"><a href="budget.php">Budget</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php">Sign Out</a></li>
                <?php
            } else {
                header("Location: /index.php");
            }?>
        </ul>
    </div>
</nav>

<div class="item_container">
    <h1>Add Item</h1>
    <form action="./budget.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="itemName" placeholder="Item Name" required>
            </div>
            <div class="form-group col-md-6">
                <input type="number" class="form-control" name="itemAmount" placeholder="Amount Spent" required>
            </div>
            <input type="submit" class="btn" value="Add Item" name="addItem">
        </div>
    </form>
</div>

</body>

</html>
