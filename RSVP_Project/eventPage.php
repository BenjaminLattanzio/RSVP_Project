<?php
include "db.php";

// Check user login or not
if(!isset($_SESSION['email'])){
  header('Location: index.php');
}

?>
<!doctype html>
<html>
<head></head>
<body>
  <h1>Homepage</h1>
  <br>
  <a href="logout.php">Logout</a>
</body>
</html>
