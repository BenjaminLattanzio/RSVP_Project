<?php
include_once('db.php');

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

if($_POST['eventName'] !=''){
  $eventName =  addslashes($_POST['eventName']);
  $eventDate =  $_POST['eventDate'];
  $rsvpDate =  $_POST['rsvpDate'];
  $eventLocation = addslashes( $_POST['eventLocation']);
  $spotsAvailable =  $_POST['spotsAvailable'];


  $newDate = strtotime($eventDate);
  $weeksBefore = strtotime("-3 week", $newDate);
  $weeksBefore =  date('Y-m-d',$weeksBefore);

  if($eventDate > $rsvpDate) {
    if($eventName!='' && $eventDate!='' && $eventLocation!='' && $spotsAvailable!='' ){
      if($weeksBefore > date('Y-m-d')){

      $sql="INSERT INTO `events` (`eventID`, `eventName`, `eventDate`, `eventLocation`, `eventCanceled`, `eventStatus`, `spotsRemaining`, `rsvp`, `createdDate`) VALUES (NULL, '$eventName', '$eventDate', '$eventLocation', 'No', 'New', '$spotsAvailable', '$rsvpDate', NOW())";

      if ($conn->query($sql) === TRUE) {
        $_SESSION['inserted'] = 1;
        header('Location: event.php');
        exit();
      }
      else
      {
        echo "failed" . $conn -> error;
      }
    }else{
      echo"Event date cannot be earlier than 3 weeks in advance. Try again. ";
    }
  }else{
      echo "Please make sure form is complete and submit again.";
    }
  }else{
    echo "RSVP date must be before event date.";
  }
}


echo "
<div class='container'>
<div class='main'>
<form class='form' method='post' action=''>

<label>Event Name :</label>
<input type='text' name='eventName' id='eventName'></br>
<label>Event Date :</label>
<input type='date' name='eventDate' id='eventDate'></br>
<label>RSVP Date :</label>
<input type='date' name='rsvpDate' id='rsvpDate'></br>
<label>Event Location :</label>
<input type='text' name='eventLocation' id='eventLocation'></br>
<label>Available Spots :</label>
<input type='number' name='spotsAvailable' id='spotsAvailable'></br>
<input type='submit' name='event_submit' id='events_submit' value='Submit'>
</form>
</div>
</div>
";
?>
