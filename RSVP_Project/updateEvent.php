<?php
include_once('db.php');

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}


function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}


$eventId = $_POST['event_id'];

if($_POST['edited'] == 'true'){
  $eventName =  addslashes($_POST['eventName']);
  $eventDate =  $_POST['eventDate'];
  $rsvpDate =  $_POST['rsvpDate'];
  $eventLocation =  addslashes($_POST['eventLocation']);
  $spotsAvailable =  $_POST['spotsAvailable'];
  $eventCancel = $_POST['cancel'] == True ? "Yes" : "No";
  $dateCancelled = 0;

  if($eventName!='' && $eventDate!='' && $eventLocation!='' && $spotsAvailable!='' && $eventCancel != '' ){

    if($eventCancel === 'Yes'){
      $dateCancelled = date("y-m-d");
    }
    $sql="UPDATE `events` SET  `eventName` = '$eventName' , `eventDate`= '$eventDate', `eventLocation`= '$eventLocation', `eventCanceled`= '$eventCancel', `spotsRemaining` = '$spotsAvailable', `rsvp` = '$rsvpDate', `dateCancelled` = '$dateCancelled' WHERE `eventID` = '$eventId'";

    if ($conn->query($sql) === TRUE) {
      $_SESSION['inserted'] = 1;
      header('Location: event.php');


    }
    else
    {
      echo "failed" . $conn -> error;
    }


  }else{
    echo "Please make sure form is complete and submit again.";
  }
}

$sql_query = "SELECT * from `events` where `eventID`= $eventId";
$result = $conn->query($sql_query);
$row = $result->fetch_assoc();



$eventName = $row['eventName'];
$eventDate = $row['eventDate'];
$eventLocation = $row['eventLocation'];
$eventCancel = $row['eventCanceled'];
$eventStatus = $row['eventStatus'];
$remainSpots = $row['spotsRemaining'];
$rsvpDate = $row['rsvp'];


echo '

<div class="container">
<div class="main">
<form class="form" method="post" action="updateEvent.php">

<label>Event Name :</label>
<input type="text" name="eventName" value ="' . $eventName . '" id="eventName"></br>
<label>Event Date :</label>
<input type="date" name="eventDate" value ="' . $eventDate . '"  id="eventDate"></br>
<label>RSVP Date :</label>
<input type="date" name="rsvpDate" value ="' . $rsvpDate . '"  id="rsvpDate"></br>
<label>Event Location :</label>
<input type="text" name="eventLocation" value ="' . $eventLocation . '" id="eventLocation"></br>
<label>Available Spots :</label>
<input type="number" name="spotsAvailable" value ="' . $remainSpots . '" id="spotsAvailable"></br>
<label>Cancel Event? </label>
<input type="checkbox" name="cancel" ' . (($eventCancel == "Yes") ? "checked" : "")  .  '  id="cancel"></br>
<input type="hidden" name="event_id" value="' . $eventId . '"  id="event_id" />
<input type="hidden" name="edited" value="true"  id="edited" />
<input type="submit" name="event_submit" id="events_submit" value="Submit">
</form>
</div>
</div>
';





?>
