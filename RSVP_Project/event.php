<?php
include_once('db.php');

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

$rowQuery = "SELECT * FROM `events`";
$numOfRow = $conn->query($rowQuery);
$maxRows = mysqli_num_rows($numOfRow);

echo "
<!doctype html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>jQuery UI Accordion - Default functionality</title>
<link rel='stylesheet' href='./css/jquery-ui-1.12.1.custom/jquery-ui.min.css'>
<script src='./js/jquery-3.5.1.min.js'></script>
<script src='./js/jquery-ui.min.js'></script>
<script>
$( function() {
  $( '#accordion' ).accordion();
} );
</script>
</head>
<body>
<div id='accordion'>
";



$tempId = $_SESSION['uId'];
try{
  $admin_query = "SELECT * from `user` where `userId`= $tempId";
  $adminResult = $conn->query($admin_query);
  $adminRows = $adminResult->fetch_assoc();
  $adminRight = $adminRows['admin'];
}catch(exception $e){

  echo $e;
}


for ($x = 1; $x <= $maxRows; $x++) {



  $sql_query = "SELECT * from `events` where `eventID`= $x";
  $result = $conn->query($sql_query);
  $row = $result->fetch_assoc();

  $spotQuery = "SELECT * FROM `rsvp` where `eventID` = $x";
  $totalSpots = $conn->query($spotQuery);
  $totalRsvp = mysqli_num_rows($totalSpots);
  $rsvpRow = $totalSpots->fetch_assoc();

  $eventid = $row['eventID'];
  $eventName = $row['eventName'];
  $eventDate = $row['eventDate'];
  $eventLocation = $row['eventLocation'];
  $eventCancel = $row['eventCanceled'];
  $eventStatus = $row['eventStatus'];
  $remainSpots = $row['spotsRemaining'];
  $rsvpDate = $row['rsvp'];
  $createdDate = $row['createdDate'];
  $cancelledDate = $row['dateCancelled'];
  $userId = $rsvpRow['userId'];

  $spotVar = $remainSpots - $totalRsvp;


  $cancelled = strtotime($cancelledDate);
  $weekAfter = strtotime("+1 week", $cancelled);
  $weekAfter =  date('Y-m-d',$weekAfter);

  if( $eventDate < date("Y-m-d")) {
    goto here;
  }

  if( $weekAfter < date("Y-m-d") && $eventCancel === "Yes"){
    goto here;
  }


  $date = strtotime($createdDate);
  $weekOld = strtotime("+1 week", $date);
  $weekOld =  date('Y-m-d',$weekOld);
  if($weekOld < date('Y-m-d')){
    $eventStatus = 'Old';
  }

  echo "<h3>";
  echo $eventName;
  echo  " </h3>
  <div>
  <p>
  <b>


  Event Date:  $eventDate    <br>
  Event Location:  $eventLocation <br>
  Was it canceled:  $eventCancel <br>
  Status:   $eventStatus <br>
  Spots Remaining:   $spotVar <br>
  RSVP by :   $rsvpDate
  </b>
  </p>
  <p>";
  if($eventCancel==="No"){
    if($rsvpDate > date("Y-m-d")){
      if($userId === $_SESSION['uId']){
        echo "<form id= 'myForm' action='cancel.php' method='POST'>
        <input type='hidden' name='event_id' value='  $eventid '  id='event_id' />
        <input type='submit' id='cancelBtn' value='Cancel'>
        </form>";
      }else if($spotVar>0) {
        echo "<form id= 'myForm' action='userInfo.php' method='POST'>
        <input type='hidden' name='event_id' value='  $eventid '  id='event_id' />
        <input type='submit' id='rsvpBtn' value='RSVP'>
        </form>";
      } else{
        echo "Event is full";
      }
    }else{
      echo "Rsvp date has past.";
    }
  }else{
    echo "Event is cancelled.";
  }
  if($adminRight == 'yes'){
    echo "<br><form id= 'myForm' action='updateEvent.php' method='POST'>
    <input type='hidden' name='event_id' value='  $eventid '  id='event_id' />
    <input type='submit' id='updateBtn' value='Update Event'>
    </form>";

  }


  echo "</p> </div>";

  here:

}
echo " </div>";


if($adminRight === "yes"){
  echo "<br><form id= 'myForm' action='createEvent.php' method='POST'>
  <input type='submit' id='createBtn' value='Create Event'>
  </form>";
}

echo "<br><form id= 'myForm' action='logout.php' method='POST'>
<input type='submit' id='logoutBtn' value='Logout'>
</form>";

echo"  </body>
</html>";



function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
