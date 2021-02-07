<?php
include ("db.php");

$fname=$_POST['name1'];
$lname=$_POST['name2']; // Fetching Values from URL.
$email=$_POST['email1'];
$phoneNum=$_POST['phoneNum'];
$password= sha1($_POST['password1']); // Password Encryption, If you like you can also leave sha1.

if($email != ""){
  $email_query = "SELECT * from `user` where (`email`='$email')";
  $emailresult = $conn->query($email_query);
  $numRowsEmail = mysqli_num_rows($emailresult);
}
if($phoneNum != 0){
  $phone_query = "SELECT * from `user` where (`phoneNum`='$phoneNum')";
  $phoneresult = $conn->query($phone_query);
  $numRowsPhone = mysqli_num_rows($phoneresult);
}

if($numRowsPhone == 0 && $numRowsEmail==0){
  $query = "INSERT INTO `user`(`userId`, `firstName`, `lastName` , `email`, `phoneNum`,  `pass`) VALUES ('', '$fname', '$lname', '$email', '$phoneNum','$password')"; // Insert query
  if($conn->query($query) === TRUE){
    $sql_query = "SELECT * from `user` where (`email`='$email' OR `phoneNum`='$phone') and `pass`='$password'";
    $result = $conn->query($sql_query);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['uId']= $row['userId'];
      echo "loggedin";
    } else {
      echo "Server Error. Try again later.";
    }
  }else
  {
    echo "Server Error. Try again later.";
  }
}else if($numRowsEmail>0){
  echo "email_used";
}else if($numRowsPhone>0){
  echo "phone_used";
}

mysqli_close ($conn);

?>
