<?php
require("../Connection/connection.php");

if($_GET['id']){
    $id = $_GET['id'];

    $delete = "DELETE FROM `departments` where department_id = '$id';";

    $result = mysqli_query($connection , $delete) or die("failed to delete query.");

    if($result){
        echo "<script>alert('Form row deleted successfully.')</script>";
        header("location: department_display.php");
    }else{
        echo "<script>alert('sorry failed to delete it')</script>";
    }

}
?>