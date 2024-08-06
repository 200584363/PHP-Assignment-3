<!-- Code by Utsav Patel -->
<!-- Header.PHP -->
<?php
session_start(); // Start the session
require_once("./config/dbconfig.php"); // connection file
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP-Assignment-3</title>
    <!-- Link for styling this page -->
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation Links -->
    <ul class="myNavigationLinks">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="member.php">Member</a></li>
        <?php
        // if the user logged into account the "Registration" window link will be hidden
        if (!isset($_SESSION['user'])) { ?>
            <li><a href="register.php">Registration</a></li>
        <?php } ?>
        <li><a href="contact.php">Contact Us</a></li>
        <li>
            <!-- Logic if the session['user'] is created "Logout" option will shown otherwise "Login" will shown-->
            <?php
            if (isset($_SESSION['user'])) {
                echo '<a href="./logout.php" class="mybtn2" style="color:white">Logout</a>';
            } else {
                echo '<a href="./index.php" class="mybtn3" style="color:white">Login</a>';
            }
            ?>
        </li>
    </ul>
</body>

</html>