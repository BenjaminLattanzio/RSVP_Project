<?php
include_once('db.php');


if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}


$eventID = $_POST['event_id'];
$userId= $_SESSION['uId'];



$sql="INSERT INTO `rsvp` ( `userId`, `eventID`, `rsvpDate`) VALUES ( '$userId', '$eventID', NOW()) ";


if ($conn->query($sql) === TRUE) {
  $_SESSION['inserted'] = 1;
  header('Location: event.php');


}
else
{
  echo "failed" . $conn -> error;
}





?>
