<!-- Code by Utsav Patel -->
<?php
// logout.php
session_start();
session_destroy(); // session destory
header("location:index.php") // after logout user will redirected to index page
?>