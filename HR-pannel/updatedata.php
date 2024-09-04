<?php

// print_r($_POST);
require "../Connection/connection.php";


$Up_fullName = mysqli_real_escape_string($connection, $_POST['up_fname']);
$Up_email = mysqli_real_escape_string($connection, $_POST['email']);
$Up_password = mysqli_real_escape_string($connection, $_POST['up_password']);
$Up_cont_Number = mysqli_real_escape_string($connection, $_POST['up_phone']);
$Up_address = mysqli_real_escape_string($connection, $_POST['up_address']);
// $guardian_Number = mysqli_real_escape_string($connection, $_POST['f-phone']);
$Up_CNIC = mysqli_real_escape_string($connection, $_POST['up_CNIC']);
$Up_dateofbirth = mysqli_real_escape_string($connection, $_POST['up_dob']);
$Up_gender = mysqli_real_escape_string($connection, $_POST['up_gender']);
// $program = mysqli_real_escape_string($connection, $_POST['program']);
// $courses = mysqli_real_escape_string($connection, $_POST['courses']);

$upd_profile = "UPDATE `users` set `full_name`='$Up_fullName',`password`='$Up_password',`phone_number`='$Up_cont_Number', `address`='$Up_address',`gender`='$Up_gender'   WHERE email = '$Up_email';";
$upd_User_Profile = mysqli_query($connection, $upd_profile);

$upd_profile_adm = "UPDATE `hr` set `DOB`='$Up_dateofbirth', `CNIC`='$Up_CNIC'   WHERE email = '$Up_email';";
$upd_admin_Profile = mysqli_query($connection, $upd_profile_adm);


if ($upd_User_Profile) {
    echo "<script>alert('Student`s Details Updated.')</script>;";
    header("location: profile.php");
} else {
    echo "<script>alert('Sorry, Failed to update this record.')</script>";
}
