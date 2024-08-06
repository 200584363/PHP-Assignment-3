<!-- dbconfig.php -->
<?php
// Database configuration
$host = 'localhost';    // DB Hostname
$dbname = 'php_assignment_3';  // DB Database Name
$username = 'root';  // DB Username
$password = ''; // DB Password   

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set the default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If an error occurs, output the error message
    echo "Connection failed: " . $e->getMessage();
}
?>