<?php
include ("../Connection/header.php");
require ("../Connection/connection.php");

if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $fullName = mysqli_real_escape_string($connection, $_POST['f-name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $phone_Number = mysqli_real_escape_string($connection, $_POST['phone']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $CNIC = mysqli_real_escape_string($connection, $_POST['CNIC']);
    $designation = mysqli_real_escape_string($connection, $_POST['designation']);

    $encrypedPassword = password_hash($password, PASSWORD_BCRYPT);
    $check = "SELECT * FROM users WHERE email='$email';";
    $res = mysqli_query($connection, $check) or die("Query failed: " . mysqli_error($connection));

    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert('Already registered. Please Login Now..!.');
              window.location.href='login.php';
              </script>";
    } else {
        $insert = "INSERT INTO `users`( `username`, `email`, `password`,`full_name` , `phone_number` , `address`,`role`,`gender`) 
                   VALUES ('$username','$email','$encrypedPassword' , '$fullName' , '$phone_Number' , '$address' , 'Employee','$gender');";
        
        $result = mysqli_query($connection, $insert) or die("Failed to insert query: " . mysqli_error($connection));
        
        if ($result) {
            echo "<script>alert('Account Successfully Created.')</script>";
        } else {
            echo "<script>alert('Failed to Register your account.')</script>";
        }

        if ($_FILES['image']['error'] == 4) {
            echo "<script>alert('Image not found')</script>";
        } else {
            $imgname = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];

            $validExtensions = ["png", "jpg", "jpeg"];
            $extension = explode(".", $imgname);
            $extension = strtolower(end($extension));

            if ($size > 1000000) {
                echo "<script>alert('File too large')</script>";
            } elseif (!in_array($extension, $validExtensions)) {
                echo "<script>alert('File type not supported')</script>";
            } else {
                $newEmpimgname = uniqid() . "." . $extension;
                $into = "INSERT INTO `employees`(`designation`,`email`,`cnic`,`profile`) 
                         VALUES ('$designation','$email','$CNIC','$newEmpimgname');";
                
                $stdTable_Data = mysqli_query($connection, $into) or die("Failed to insert into employees: " . mysqli_error($connection));
                
                if ($stdTable_Data) {
                    move_uploaded_file($tmpname, "images/" . $newEmpimgname);
                    echo "<script>alert('Form Registered successfully')
                    window.location.href='login.php';</script>";
                }
            }
        }
    }
}
?>

<body>
    <div class="container my-4">
        <h1 class="text-center">Employee Signup</h1>
        <form action="" method="post" enctype="multipart/form-data" class="form-group">
            <input type="text" name="username" id="" class="form-control my-2" placeholder="Enter username">
            <input type="text" name="f-name" id="" class="form-control my-2" placeholder="Enter Your Full Name">
            <input type="email" name="email" id="" class="form-control my-2" placeholder="Enter email">
            <input type="password" name="password" id="" class="form-control my-2" placeholder="Enter a strong password">
            <input type="text" name="address" id="" class="form-control my-2" placeholder="Enter Your Address">
            <input type="number" name="phone" id="" placeholder="Enter Your Phone Number"> <br><br>
            <input type="number" name="CNIC" placeholder="CNIC/B-FORM" id=""><br><br>
            <label for="">Select Job title</label>
            <select name="designation" id="">
                <option value="" selected disabled>Select Any</option>
                <option value="Faculty">Faculty</option>
                <option value="Accountant">Accountant</option>
                <option value="Marketing">Marketing</option>
                <option value="SRO">SRO</option>
            </select><br><br>
            
            <label for="">Select Gender</label>
            <select name="gender" id="">
                <option value="" selected disabled>Select Any</option>
                <option value="male">Male</option>
                <option value="female">Female</option>                
            </select><br>
            <input class="form-control my-3" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
            <input type="submit" name="signup" id="" class="form-control btn btn-primary my-2">
        </form>
    </div>
</body>
</html>
