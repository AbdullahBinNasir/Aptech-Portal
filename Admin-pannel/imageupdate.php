<?php


require "../Connection/connection.php";
// include "./Components/header.php";

if (isset($_POST['imgUpdate']) && $_SERVER['REQUEST_METHOD'] == "POST") {


    echo $adm_email = $_POST['adm_email'];
    // echo"<pre>";
    // print_r($_FILES['image']);
    // echo"</pre>";
    if ($_FILES['image']['error'] == 4) {
        echo "
    <script>alert('Image not found')</script>";
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
            $newadmimg = uniqid() . "." . $extension; //4545gh45rt454242.jpg
            $upd_adm_profile = "UPDATE `admins` set `Profile`='$newadmimg' WHERE user_email = '$adm_email';";
            $result = mysqli_query($connection, $upd_adm_profile) or die("failed");
            if ($result) {
                move_uploaded_file($tmpname, "../Auth/images/" . $newadmimg);
                echo "<script>alert('image update succesfully')</script>";
                header("location: profile.php");
                echo"<pre>";
                print_r($_FILES['image']);
                echo"</pre>";

            }
        }
    }
}
