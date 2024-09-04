<?php 

// print_r($_POST);
require "../Connection/connection.php";

$id=$_POST['id'];
$name=$_POST['name'];
$description=$_POST['description'];
$location=$_POST['location'];
$organizer=$_POST['organizer'];
$date=$_POST['date'];
$deadline=$_POST['deadline'];
$attendence =$_POST['attendence'];
 
$update = "UPDATE `events` SET `event_name`='$name', `description`='$description', `event_date`='$date', `location`='$location', `organizer_id`='$organizer', `registration_deadline`='$deadline', `max_attendees`='$attendence' WHERE `event_id`='$id';";



$result=mysqli_query($connection , $update) or die("failed to update query.");
if($result){
   echo "<script>alert('Student`s Details Updated.')</script>;";
   header("location: abc_display.php");
}
else{
    echo "<script>alert('Sorry, Failed to update this record.')</script>";
}

?>