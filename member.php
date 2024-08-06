<!-- Code by Utsav Patel -->
<?php
require_once("config/dbconfig.php"); // connection file
include("./templates/header.php"); // navigation links (header.php)
if (isset($_SESSION['user'])) {
    // if SESSION created then fetch the data from the database "users" table
    $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = :Email");
    $stmt->bindParam(':Email', $_SESSION['user']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <html>

    <head>
        <title>Member | Private Page</title>
        <!-- Link for styling this page -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <section class="memberSection">
            <div class="memberProfile">
                <img src="./images/profile.png" alt="ProfileImage" />
                <div id="memberDetails">
                    <!-- Fetching user details from database -->
                    <h1>Welcome to the members area, <?php echo htmlspecialchars($user['FirstName']) . " " . htmlspecialchars($user['LastName']); ?>!</h1>
                    <p>Email: <?php echo htmlspecialchars($user['Email']); ?></p>
                </div>
            </div>
            <center>
                <!-- Premium Products Cards -->
                <h2>Our Premium Products</h2>
                <div class="myProducts">
                    <div class="subProducts">
                        <img src="images/membershoes1.jpeg" alt="membershoes1" />
                        <br /><button>Nike Air Max Premium</button>
                    </div>
                    <div class="subProducts">
                        <img src="images/membershoes4.jpeg" alt="membershoes4" />
                        <br /><button>Nike Dunk Low</button>
                    </div>
                    <div class="subProducts">
                        <img src="images/membershoes2.jpeg" alt="membershoes2" />
                        <br /><button>Nike G.T Hustle 3 Electric</button>
                    </div>
                </div>
            </center>
        </section>
    </body>

    </html>
<?php
} else {
    // for force entry previntion
    header('Location: index.php?error');
}
include("templates/footer.php");
?>