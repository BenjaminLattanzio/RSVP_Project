<?php
include_once('db.php');

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

$rowQuery = "SELECT * FROM `events`";
$result = $conn->query($rowQuery);
while($row = mysqli_fetch_array($result)){

  $eventID = $row['eventID'];
  $eventName = $row['eventName'];
  $eventDate = $row['eventDate'];
  $eventLocation = $row['eventLocation'];
  $eventCancel = $row['eventCanceled'];
  $eventStatus = $row['eventStatus'];
  $remainSpots = $row['spotsRemaining'];
  $rsvpDate = $row['rsvp'];
  $createdDate = $row['createdDate'];

  $return_arr[] = array("eventID" => $eventID,
  "eventName" => $eventName,
  "eventDate" => $eventDate,
  "eventLocation" => $eventLocation,
  "eventCancel" => $eventCancel,
  "eventStatus" => $eventStatus,
  "remainSpots" => $remainSpots,
  "rsvpDate" => $rsvpDate,
  "createdDate" => $createdDate);
}

echo json_encode($return_arr);

?>
