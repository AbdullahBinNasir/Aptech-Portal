<?php
include("../Connection/header.php");
require("../Connection/connection.php");

if (isset($_POST['signup'])) {

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $father_Name = mysqli_real_escape_string($connection, $_POST['father-name']);
    $father_Occupation = mysqli_real_escape_string($connection, $_POST['father-occupation']);
    $fullName = mysqli_real_escape_string($connection, $_POST['f-name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $std_Number = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $guardian_Number = mysqli_real_escape_string($connection, $_POST['f-phone']);
    $CNIC = mysqli_real_escape_string($connection, $_POST['CNIC']);
    $program = mysqli_real_escape_string($connection, $_POST['program']);
    $courses = mysqli_real_escape_string($connection, $_POST['courses']);

    $encrypedPassword = password_hash($password, PASSWORD_BCRYPT);
    $check = "SELECT * FROM users WHERE email='$email';";
    $res = mysqli_query($connection, $check) or die("failed");

    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert('Already registered. Please Login Now..!.')
    window.location.href='login.php';
    </script>;";
    } else {

        $insert = "INSERT INTO `users`( `username`, `email`, `password`,`full_name` , `phone_number` , `address`  ) VALUES ('$username','$email','$encrypedPassword' , '$fullName' , '$std_Number' , '$address'  );";

        $result = mysqli_query($connection, $insert) or die("failed to insert query.");
        if ($result) {
            echo "<script>alert('Account Succesfully Created.')
            window.location.href='login.php'  ; 
   </script>;";
        }


        if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] == "POST") {
            // echo $name = $_POST['name'];
            // echo $price = $_POST['price'];
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
                    $newimgname = uniqid() . "." . $extension;



                    $into = "INSERT INTO `students`(`program` ,`current_courses` , `CNIC` , `Father_Name` , `Father_Occupation`,`Guardian_Phone` , `profile`,`email`) VALUES ('$program','$courses' , '$CNIC','$father_Name' , '$father_Occupation' , '$guardian_Number' ,'$newimgname','$email' );";
                    $stdTable_Data = mysqli_query($connection, $into) or die("failed");


                    if ($stdTable_Data) {
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

?>

<body>
    <div class="container my-4">
        <h1 class="text-center">Student Signup</h1>
        <form action="" method="post" enctype="multipart/form-data" class="form-group">
            <input type="text" name="username" id="" class="form-control my-2" placeholder="Enter username">
            <input type="text" name="father-name" id="" class="form-control my-2" placeholder="Enter Father Name">
            <input type="text" name="father-occupation" id="" class="form-control my-2" placeholder="Enter Father Occupation">
            <input type="text" name="f-name" id="" class="form-control my-2" placeholder="Enter Your Full Name">
            <input type="email" name="email" id="" class="form-control my-2" placeholder="Enter email">
            <input type="password" name="password" id="" class="form-control my-2" placeholder="Enter a strong password">
            <input type="text" name="address" id="" class="form-control my-2" placeholder="Enter Your Address">
            <input type="number" name="phone" id="" placeholder="Enter Your Phone Number" class="form-control"> <br> <br>
            <input type="number" name="f-phone" id="" placeholder="Enter Your Guardian Phone Number" class="form-control"> <br> <br>
            <input type="number" name="CNIC" placeholder="CNIC/B-FORM" id="" class="form-control">
            <input class="form-control my-3" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
            <select name="program" id="">
                <option value="ADSE">ADSE</option>
                <option value="DISM">DISM</option>
                <option value="CPISM">CPISM</option>
            </select>
            <select name="courses" id="">
                <option value="FrontEnd-Dev">FrontEnd-Development</option>
                <option value="BackEnd-Dev">BackEnd-Development</option>
            </select>
            <input type="submit" name="signup" id="" class="form-control btn btn-primary my-2">
        </form>
    </div>
</body>

</html>