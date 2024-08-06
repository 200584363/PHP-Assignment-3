<!-- Code by Utsav Patel -->
<!-- Contact.php -->
<?php
require_once 'config/dbconfig.php'; // included connection file to connect to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $comment = $_POST['Comment'];

    // try catch statement for validation of code
    try {
        $stmt = $pdo->prepare("INSERT INTO contact_details (FullName, Email, Comment) VALUES (:FullName, :Email, :Comment)");
        $stmt->bindParam(':FullName', $fullName);
        $stmt->bindParam(':Email', $email);
        $stmt->bindParam(':Comment', $comment);
        $stmt->execute();

        header('Location: contact.php?success');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Contact</title>
    <!-- Link for styling this page -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script if the $_REQUEST['success'] then script will executed using following function-->
    <script>
        function myFunction() {
            alert("Thank You for Contacting Us");
        }
    </script>
</head>

<body <?php if (isset($_REQUEST['success'])) {
            echo "onload='myFunction()'";
        } ?>>
    <!-- calling header.php -->
    <?php include("templates/header.php"); ?>
    <section class="myRegisterPage">
        <h1>Contact Us</h1>

        <div class="myForm">
            <form action="contact.php" method="post">


                <?php if (isset($_SESSION['user'])) {
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :Email");
                    $stmt->bindParam(':Email', $_SESSION['user']);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                    <label for="FullName">Full name:</label>
                    <input type="text" id="FullName" autocomplete="off" name="FullName" readonly value="<?php echo $user['FirstName'] . " " . $user['LastName'] ?>"><br /><br />
                    <label for="Email">Your ID:</label>
                    <input type="email" id="Email" name="Email" value="<?php echo $_SESSION['user'] ?>" readonly><br /><br />
                <?php
                } else { ?>
                    <label for="FullName">Full name:</label>
                    <input type="text" id="FullName" autocomplete="off" name="FullName" required placeholder="Your Full Name"><br /><br />
                    <label for="Email">Email ID:</label>
                    <input type="email" id="Email" autocomplete="off" name="Email" required placeholder="Your email id"><br /><br />
                <?php } ?>
                <label for="comment">Comment:</label>
                <textarea placeholder="Your Comment Here" name="Comment"></textarea><br /><br /><br />
                <button type="submit" class="mybtn">Send</button>
            </form>
        </div>
    </section>
</body>
<?php include("templates/footer.php"); ?>

</html>