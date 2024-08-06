<!-- Code by Utsav Patel -->
<!DOCTYPE html>
<html>

<head>
    <title>Home | Assignment-3</title>
    <!-- Link for styling this page -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script if the $_REQUEST['error'] then script will executed using following function-->
    <script>
        function myFunction() {
            alert("Login First to Access Member Page");
        }
    </script>
</head>

<!-- if someone trying to access member page without session created he/she will redirected to this page with
alert showing "Login First To Access Member Page" -->

<body <?php if (isset($_REQUEST['error'])) {
            echo "onload='myFunction()'";
        } ?>>
    <?php
    require_once("config/dbconfig.php"); // included connection file to connect to the database 
    include("templates/header.php"); // calling header.php

    ?>
    <div class="homeContent">
        <h2>Shop All New Arrivals</h2>
        <center><img src="images/heroimg.png" class="myImg1" alt="HeroImg"></center>
        <h1>Shop Our Icons</h1>
        <center>
            <!-- Products using Cards -->
            <div class="myProducts">
                <div class="subProducts">
                    <img src="images/shoes1.jpeg" alt="shoes1" />
                    <button>Pegasus</button>
                </div>
                <div class="subProducts">
                    <img src="images/shoes2.jpeg" alt="shoes2" />
                    <button>Air Max 90</button>
                </div>
                <div class="subProducts">
                    <img src="images/shoes3.jpeg" alt="shoes3" />
                    <button>Metcon</button>
                </div>
                <div class="subProducts">
                    <img src="images/shoes4.jpeg" alt="shoes4" />
                    <button>Nike Clam</button>
                </div>
                <div class="subProducts">
                    <img src="images/shoes5.jpeg" alt="shoes5" />
                    <button>Air Jordan</button>
                </div>
            </div>
        </center>
    </div>
    <?php

    // checking whether SESSION is created or not 
    if (isset($_SESSION['user'])) {
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            try {
                // query for fetching data of user from phpMyAdmin
                $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :Email");
                $stmt->bindParam(':Email', $email);
                $stmt->execute();
                $user = $stmt->fetch();

                // comparing if the email and password is matched or not
                if ($user && $password === $user['Password']) {
                    $_SESSION['user'] = $user['Email'];
                    header('Location: member.php');
                    exit();
                } else {
                    // if value inserted is invalid then this statement will execute
                    $error = "Invalid email or password";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        // IF the user logged in this will hidden and if not following statement will execute
        if (!isset($_SESSION['user'])) {
    ?>
            <marquee>To Access Our Premium Products Login or Register Now!!!</marquee>
        <?php
        }
        ?>
        <!-- Login Section -->
        <section class="myRegisterPage">
            <h1>Login</h1>
            <div class="myForm">
                <?php if (isset($error)) echo "<p class='alert'>$error</p>"; ?>
                <form action="index.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" autocomplete="off" placeholder="Your Email ID" name="Email" required><br /><br />
                    <label for="password">Password:</label>
                    <input type="password" id="password" autocomplete="off" placeholder="Your Password" name="Password" required><br /><br />
                    <button type="submit" class="mybtn">Login</button>
                </form>
                <div class="subLinks">Don't have an account? <a href="register.php">Register</a></div>
            </div>
        </section>
        <!-- End of Login Section -->
    <?php
    }
    ?>
    </div>
</body>
<?php include("templates/footer.php"); ?> <!-- including footer -->

</html>