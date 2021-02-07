<?php
include_once('db.php');



if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}


$eventID = $_POST['event_id'];
$userId= $_SESSION['uId'];



$sql="DELETE FROM `rsvp` WHERE `userId`='$userId' AND `eventID` = '$eventID'";


if ($conn->query($sql) === TRUE) {
  header('Location: event.php');


}
else
{
  echo "failed" . $conn -> error;
}





?>
