<?php

// print_r($_POST);
require "../Connection/header.php";
include "../Connection/connection.php";

$id = $_POST['id'];
$batch_name = $_POST['batch_name'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];


$update = "UPDATE `batches` set `batch_name`='$batch_name',`start_date`='$start_date',`end_date`='$end_date' WHERE batch_id= '$id';";



$result = mysqli_query($connection, $update) or die("failed to update query.");
if ($result) {
    echo "<script>alert('Student`s Details Updated.')</script>;";
       header("location: ViewBatch.php");
} else {
    echo "<script>alert('Sorry, Failed to update this record.')</script>";
}
