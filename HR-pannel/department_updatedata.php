<?php 

// print_r($_POST);
require "../Connection/connection.php";

$id=$_POST['id'];
$name=$_POST['name'];
$location=$_POST['location'];
$head=$_POST['head'];
$contact=$_POST['contact'];

 
$update = "UPDATE `departments` SET `department_name`='$name', `head_of_department`='$head', `location`='$location', `contact_details`='$contact' WHERE `department_id`='$id';";



$result=mysqli_query($connection , $update) or die("failed to update query.");
if($result){
   echo "<script>alert('Student`s Details Updated.')</script>;";
   header("location: department_display.php");
}
else{
    echo "<script>alert('Sorry, Failed to update this record.')</script>";
}

?>