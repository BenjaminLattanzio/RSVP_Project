<?php
include "db.php";

$email = mysqli_real_escape_string($conn,$_POST['email']);
$phone = mysqli_real_escape_string($conn,$_POST['phone']);
$password = mysqli_real_escape_string($conn,sha1($_POST['password']));



if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

$sql_query = "SELECT * from `user` where (`email`='$email' OR `phoneNum`='$phone') and `pass`='$password'";
$result = $conn->query($sql_query);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $_SESSION['uId']= $row['userId'];
  echo 1;
} else {
  echo 0 ;
}
$conn->close();
