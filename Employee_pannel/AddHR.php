<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
    $profile = "SELECT u.*, h.* FROM users u INNER JOIN hr h ON u.email = h.email WHERE u.email = '" . $_SESSION['email'] . " ';";

    $get_Pic = mysqli_query($connection, $profile);


    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {
?>


            <body>
            <link rel="stylesheet" href="./src/styles/style1.css">

                <!-- Pre-loader  Starts-->
                <?php
                // include "./Components/Preloader.php";
                ?>
                <!-- Pre-loader  Ends-->


                <!-- top-navbar Starts Here -->
                <?php
                include "./Components/navbar.php";
                ?>
                <!-- top-navbar Ends Here -->



                <!-- Right Sidebar starts Here...! -->
                <?php
                include "./Components/rightSidebar.php";
                ?>
                <!-- Right Sidebar Ends Here...! -->

                <!-- Left Sidebar starts Here...! -->
                <?php
                include "./Components/leftSidebar.php";
                ?>
                <!-- Left Sidebar Ends Here...! -->


                <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                    <div class="pd-ltr-20 xs-pd-20-10">


                        <div class="min-height-200px">



                            <div class="page-header">

                                <?php
                                // include("../Connection/header.php");
                                // require("../Connection/connection.php");

                                if (isset($_POST['signup'])) {

                                    $username = mysqli_real_escape_string($connection, $_POST['username']);
                                    $fullName = mysqli_real_escape_string($connection, $_POST['f-name']);
                                    $email = mysqli_real_escape_string($connection, $_POST['email']);
                                    $password = mysqli_real_escape_string($connection, $_POST['password']);
                                    $std_Number = mysqli_real_escape_string($connection, $_POST['phone']);
                                    $address = mysqli_real_escape_string($connection, $_POST['address']);
                                    $CNIC = mysqli_real_escape_string($connection, $_POST['CNIC']);
                                    $Hr_DOB = mysqli_real_escape_string($connection, $_POST['dob']);
                                    $Hr_Position = mysqli_real_escape_string($connection, $_POST['position']);

                                    $encrypedPassword = password_hash($password, PASSWORD_BCRYPT);
                                    $check = "SELECT * FROM users WHERE email='$email';";
                                    $res = mysqli_query($connection, $check) or die("failed");

                                    if (mysqli_num_rows($res) > 0) {
    //                                     echo "<script>alert('Already registered. Please Login Now..!.')
    // window.location.href='ViewHR.php';
    // </script>;";
                                    } else {

                                        $insert = "INSERT INTO `users`( `username`, `email`, `password`,`full_name` , `phone_number` , `address` , `role`, 	`is_approved` ) VALUES ('$username','$email','$encrypedPassword' , '$fullName' , '$std_Number' , '$address', 'HR', 1 );";

                                        $result = mysqli_query($connection, $insert) or die("failed to insert query.");
                                        if ($result) {
                                                         


                                        if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] == "POST") {

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
                                                    $newimgname = uniqid() . "." . $extension;
                                                    $into = "INSERT INTO `hr`(`DOB` , `CNIC` , `profile`,`email`,`role`,`department_id`) VALUES ('$Hr_DOB', '$CNIC','$newimgname','$email','$Hr_Position',4);";
                                                    $HRTable_Data = mysqli_query($connection, $into) or die("failed");


                                                    if ($HRTable_Data) {
                                                        move_uploaded_file($tmpname, "images/" . $newimgname);
                                                        echo "<script>alert('From Registerd succesfully')</script>";
                                                    }
                                                }
                                            }
                                        } else {
                                            echo "<script>alert('Failed to Register your account.')</script>";
                                        }
                                    }
                                }

                                echo "<script>alert('Account Succesfully Created.')
                                window.location.href='ViewHR.php';  
                       </script>;";
                                       
                            }
                                ?>
 <!-- window.location.href='ViewHR.php'  ;  -->
                                <!-- <body> -->
                                <div class="container my-4">
                                    <h1 class="text-center">Hr Form</h1>
                                    <form action="" method="post" enctype="multipart/form-data" class="form-group">
                                        <!-- Username -->
                                        <div class="form-group">
                                        <label for="username">Enter Username</label>
                                        <input type="text" name="username" id="" class="form-control my-2 red-input" placeholder="Enter username">
                                        </div>
                                        <!-- Full Name -->
                                        <div class="form-group">
                                        <label for="f-name">Enter Full Name</label>
                                        <input type="text" name="f-name" id="f-name" class="form-control my-2 red-input" placeholder="Enter Your Full Name">
                                        </div>
                                        <!-- Email -->
                                        <div class="form-group">
                                        <label for="email">Enter Email</label>
                                        <input type="email" name="email" id="email" class="form-control my-2 red-input" placeholder="Enter email">
                                        </div>
                                        <!-- Password -->

                                        <div class="form-group">
                                        <label for="password">Enter Password</label>
                                        <input type="password" name="password" id="password" class="form-control my-2 red-input" placeholder="Enter a strong password">
                                        </div>
                                        <!-- Address -->
                                        <div class="form-group">
                                        <label for="address">Enter Address</label>
                                        <input type="text" name="address" id="address" class="form-control my-2 red-input" placeholder="Enter Your Address">
                                        </div>
                                        <!-- DOB -->
                                        <div class="form-group">
                                        <label for="dob">Enter Date Of Birth</label>
                                        <input type="date" name="dob" id="dob" class="form-control my-2 red-input" placeholder="Enter Your Date Of Birth">
                                        </div>
                                        <!-- Number -->
                                        <div class="form-group">
                                        <label for="phone">Enter Phone Number</label>
                                        <input type="number" name="phone" id="phone" placeholder="Enter Your Phone Number" class="form-control red-input">
                                        </div>
                                        <!-- CNIC -->
                                        <div class="form-group">
                                        <label for="CNIC">Enter CNIC</label>
                                        <input type="number" name="CNIC" placeholder="CNIC/B-FORM" id="CNIC" class="form-control red-input">
                                        </div>

                                        <!-- Position -->
                                        <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" name="position" placeholder="Position" id="position" class="form-control red-input">
                                        </div>
                                        <!-- Image -->
                                        <div class="form-group">
                                        <label for="image">Upload Profile</label>
                                        <input class="form-control my-3 red-input" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
                                        </div>

                                        <input type="submit" name="signup" id="" class="form-control btn btn-danger my-2 text-light">
                                    </form>
                                </div>
                                <!-- </body> -->

                                <!-- </html> -->

                            </div>





                        </div>

                        <!-- Footer Starts Here -->
                        <?php
                        include "./Components/footer.php";
                        ?>
                        <!-- Footer Ends Here -->
                    </div>
                </div>
                <!-- js -->
                <script src="vendors/scripts/core.js"></script>
                <script src="vendors/scripts/script.min.js"></script>
                <script src="vendors/scripts/process.js"></script>
                <script src="vendors/scripts/layout-settings.js"></script>
            </body>

            </html>

<?php

        }
    }
}

?>