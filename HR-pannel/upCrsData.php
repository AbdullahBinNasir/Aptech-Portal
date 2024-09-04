<?php

// print_r($_POST);
require "../Connection/connection.php";


// $Up_fullName = mysqli_real_escape_string($connection, $_POST['up_fname']);
// $Up_email = mysqli_real_escape_string($connection, $_POST['email']);
// $Up_password = mysqli_real_escape_string($connection, $_POST['up_password']);
// $Up_cont_Number = mysqli_real_escape_string($connection, $_POST['up_phone']);
// $Up_address = mysqli_real_escape_string($connection, $_POST['up_address']);
// $guardian_Number = mysqli_real_escape_string($connection, $_POST['f-phone']);
// $Up_CNIC = mysqli_real_escape_string($connection, $_POST['up_CNIC']);
// $Up_dateofbirth = mysqli_real_escape_string($connection, $_POST['up_dob']);
// $Up_gender = mysqli_real_escape_string($connection, $_POST['up_gender']);
// $program = mysqli_real_escape_string($connection, $_POST['program']);
// $courses = mysqli_real_escape_string($connection, $_POST['courses']);
$crsTitle = mysqli_real_escape_string($connection, $_POST['course_name']);
$crsID = mysqli_real_escape_string($connection, $_POST['id']);
$crsDesc = mysqli_real_escape_string($connection, $_POST['Description']);
// $crsDesc = mysqli_real_escape_string($connection, $_POST['image']);

if (isset($_POST['Add']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    // echo $name=$_POST['name'];
    // echo $price=$_POST['price'];
    // echo"<pre>";
    // print_r($_FILES['image']);
    // echo"</pre>";
    if ($_FILES['image']['error'] == 4) {
       
        $upd_Crs = "UPDATE `courses` set `Course_Title`='$crsTitle',`Description`='$crsDesc'  WHERE Course_id = '$crsID';";
        $updated_Crs = mysqli_query($connection, $upd_Crs);
        header("location: Courses.php");

        // echo "<pre>";
        // print_r($_FILES['image']);
        // echo "</pre>";

    } else {

        $imgname = $_FILES['image']['name']; //samsung.jpg
        $tmpname = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size']; //44397

        $validExtensions = ["png", "jpg", "jpeg"];
        // samsung.jpg
        $extension = explode(".", $imgname); // ["samsung", "jpg"]
        // print_r($extension);
        $extension = strtolower(end($extension)); //jpg

        if ($size > 1000000) {
            echo "<script>alert('File too large')</script>";
        } elseif (!in_array($extension, $validExtensions)) {
            echo "<script>alert('File type not supported')</script>";
        } else {

            echo "<pre>";
            print_r($_FILES['image']);
            echo "</pre>";

            $newUpimgname = uniqid() . "." . $extension; //4545gh45rt454242.jpg
            // $insert="INSERT INTO `mobiles`( `name`, `price`, `image`) VALUES ('$name','$price','$newimgname')";
            // $result = mysqli_query($connection, $insert) or die("failed");
            // if ($result) {
            //     move_uploaded_file($tmpname, "images/" . $newimgname);
            //     echo "<script>alert('Product registered succesfully')</script>";
            // }

            $upd_Crs = "UPDATE `courses` set `Course_Title`='$crsTitle',`Description`='$crsDesc', `image` = '$newUpimgname'  WHERE Course_id = '$crsID';";
            $updated_Crs = mysqli_query($connection, $upd_Crs);

            if ($updated_Crs) {

                move_uploaded_file($tmpname, "images/" . $newUpimgname);
                // echo "<script>alert('Product registered succesfully')</script>";
                echo "<script>alert('Courses Details Updated.')</script>;";
                header("location: Courses.php");
            } else {
                echo "<script>alert('Sorry, Failed to update this record.')</script>";
            }
        }
    }
}
