<?php

// print_r($_POST);
require "../Connection/connection.php";


$Up_fullName = mysqli_real_escape_string($connection, $_POST['up_fname']);
$Up_email = mysqli_real_escape_string($connection, $_POST['email']);
$Up_password = mysqli_real_escape_string($connection, $_POST['up_password']);
$Up_cont_Number = mysqli_real_escape_string($connection, $_POST['up_phone']);
$Up_address = mysqli_real_escape_string($connection, $_POST['up_address']);
$performance_Review = mysqli_real_escape_string($connection, $_POST['performance_Review']);
$Up_CNIC = mysqli_real_escape_string($connection, $_POST['up_CNIC']);
// $Up_stdbatch = mysqli_real_escape_string($connection, $_POST['batch_id']);
$Up_gender = mysqli_real_escape_string($connection, $_POST['up_gender']);
$iSApprove = mysqli_real_escape_string($connection, $_POST['decision']);
// $iSDecline = mysqli_real_escape_string($connection, $_POST['isDecline']);
$salary = mysqli_real_escape_string($connection, $_POST['up_salary']);
// $courses = mysqli_real_escape_string($connection, $_POST['courses']);

$hiredate = date("Y-m-d");



if ($iSApprove == 1) {
  
    $upd_profile = "UPDATE `users` set `full_name`='$Up_fullName',`password`='$Up_password',`phone_number`='$Up_cont_Number', `address`='$Up_address',`gender`='$Up_gender',`is_approved`= '$iSApprove'   WHERE email = '$Up_email';";
    $upd_User_Profile = mysqli_query($connection, $upd_profile);

    $upd_profile_adm = "UPDATE `employees` set `hire_date`='$hiredate', `cnic`='$Up_CNIC' ,`performance_reviews`='$performance_Review', `salary`='$salary'  WHERE email = '$Up_email';";
    $upd_admin_Profile = mysqli_query($connection, $upd_profile_adm);


    if ($upd_User_Profile) {
        echo "<script>alert('Student`s Details Updated.')</script>;";
        header("location: PendingApprovalfaculty.php");
    } else {
        echo "<script>alert('Sorry, Failed to update this record.')</script>";  
    }


} else {

    // if($iSApprove == )

    $upd_profile = "UPDATE `users` set `full_name`='$Up_fullName',`password`='$Up_password',`phone_number`='$Up_cont_Number', `address`='$Up_address',`gender`='$Up_gender',`is_approved`= '$iSApprove'   WHERE email = '$Up_email';";
    $upd_User_Profile = mysqli_query($connection, $upd_profile);

    $upd_profile_adm = "UPDATE `employees` set , `cnic`='$Up_CNIC' WHERE email = '$Up_email';";
    $upd_admin_Profile = mysqli_query($connection, $upd_profile_adm);


    if ($upd_User_Profile) {
        echo "<script>alert('Student`s Details Updated.')</script>;";
        header("location: faculty.php");
    } else {
        echo "<script>alert('Sorry, Failed to update this record.')</script>";
    }
}
