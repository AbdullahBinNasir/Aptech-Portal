<?php

require("../Connection/connection.php");

if($_GET['id']){
    $email = $_GET['id'];

    $delete = "DELETE FROM `hr` where `email` = '$email';";
    $result = mysqli_query($connection , $delete) or die("failed to delete query.");
    
    
    $deleteUser = "DELETE FROM `users` where `email` = '$email';";
    $result2 = mysqli_query($connection , $deleteUser) or die("failed to delete query.");





    if($result){
        echo "<script>alert('Form row deleted successfully.')</script>";
        header("location: ViewHr.php");
    }else{
        echo "<script>alert('sorry failed to delete it')</script>";
    }

}

?>