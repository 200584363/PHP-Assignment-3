<!-- Code by Utsav Patel -->
<!-- register.php -->
<?php
require_once 'config/dbconfig.php'; // included connection file to connect to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // try catch statement for validation of code
    try {
        // Query to insert the user data into database 
        $stmt = $pdo->prepare("INSERT INTO users (FirstName, LastName, Email, Password) VALUES (:FirstName, :LastName, :Email, :Password)");
        $stmt->bindParam(':FirstName', $firstName);
        $stmt->bindParam(':LastName', $lastName);
        $stmt->bindParam(':Email', $email);
        $stmt->bindParam(':Password', $password);
        $stmt->execute();

        // if data inserted then session will created
        $_SESSION['user'] = $user['Email'];
        header('Location: index.php?success');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <!-- Link for styling this page -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- calling header.php -->
    <?php include("templates/header.php"); ?>
    <section class="myRegisterPage">
        <h1>Registration</h1>
        <!-- Registration Section -->
        <div class="myForm">
            <form action="register.php" method="post">
                <label for="FirstName">First name:</label>
                <input type="text" id="FirstName" autocomplete="off" name="FirstName" required placeholder="Your first name"><br /><br />

                <label for="LastName">Last name:</label>
                <input type="text" id="LastName" autocomplete="off" name="LastName" required placeholder="Your last name"><br /><br />

                <label for="Email">Email ID:</label>
                <input type="email" id="Email" autocomplete="off" name="Email" required placeholder="Your email id"><br /><br />

                <label for="Password">Password:</label>
                <input type="password" id="Password" autocomplete="off" name="Password" required placeholder="Your password"><br /><br /><br />
                <button type="submit" class="mybtn">Register</button>
            </form>
            <div class="subLinks">Already have account? <a href="member.php">Login</a></div>
        </div>
    </section>
    <!-- End of registration Section -->
</body>
<?php include("templates/footer.php"); ?>

</html>