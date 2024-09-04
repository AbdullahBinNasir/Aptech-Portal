<?php
include ("../Connection/header.php");
require ("../Connection/connection.php");

if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $father_Name = mysqli_real_escape_string($connection, $_POST['father-name']);
    $fullName = mysqli_real_escape_string($connection, $_POST['f-name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $std_Number = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $CNIC = mysqli_real_escape_string($connection, $_POST['CNIC']);
    $designation = mysqli_real_escape_string($connection, $_POST['designation']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);

    $encrypedPassword = password_hash($password, PASSWORD_BCRYPT);
    $check = "SELECT * FROM users WHERE email='$email';";
    $res = mysqli_query($connection, $check) or die("failed");

    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert('Already have Account.') </script>";
    } else {
        $insert = "INSERT INTO users(username, email, password, full_name, phone_number, address,role) VALUES ('$username','$email','$encrypedPassword','$fullName','$std_Number','$address','Employee');";
        $result = mysqli_query($connection, $insert) or die("failed to insert query.");
        if ($result) {
            echo "<script>alert('Account Successfully Created.')
				window.location.href = '../HR-pannel/HR_Dashboard.php'; 
			</script>;";
        }

        if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] == "POST") {
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
                    $stdTable_Data = mysqli_query($connection, $into) or die("failed");

                    if ($stdTable_Data) {
                        move_uploaded_file($tmpname, "images/" . $newimgname);
                        echo "<script>alert('Form Registered successfully')</script>";
                    }
                }
            }
        } else {
            echo "<script>alert('Failed to Register your account.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aptech Portal Signup</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../Admin-pannel/vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Admin-pannel/vendors/images/Aptech-Favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Admin-pannel/vendors/images/Aptech-Favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Admin-pannel/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../Admin-pannel/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../Admin-pannel/src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="../Admin-pannel/vendors/styles/style.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo my-3">
                <a href="logIn.php">
                    <img src="../Admin-pannel/vendors/images/apt_logo.png" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="logIn.php" class="text-danger">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="../Admin-pannel/vendors/images/register_image.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="register-box bg-white box-shadow border-radius-10">
                        <div class="wizard-content">
                            <form class="tab-wizard2 wizard-circle wizard" method="post" enctype="multipart/form-data"
                                id="registrationForm">
                                <h5>Basic Account Credentials</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email Address*</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Username*</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="username" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Password*</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Father Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="father-name" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h5>Personal Information</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Full Name*</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="f-name" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label class="col-sm-4 col-form-label">Profile*</label>
                                            <div class="col-sm-8">
                                                <input class="form-control my-3" type="file" name="image" id="image"
                                                    accept=".jpg, .png, .jpeg">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Address</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="address" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Phone Number</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="phone" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h5>Confirmation</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">CNIC</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="CNIC" class="form-control"
                                                    oninput="updateOverview()">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Job Title</label>
                                            <div class="col-sm-8">
                                                <select name="designation" id="" class="form-control">
                                                    <option value="" selected disabled>Select Any</option>
                                                    <option value="Faculty">Faculty</option>
                                                    <option value="Accountant">Accountant</option>
                                                    <option value="Marketing">Marketing</option>
                                                    <option value="SRO">SRO</option>
                                                    <option value="Coordinator">Coordinator</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Gender</label>
                                            <div class="col-sm-8">
                                                <select name="gender" id="" class="form-control">
                                                    <option value="" selected disabled>Select Any</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select><br>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h5>Confirmation</h5>
                                <section>
                                    <div class="form-wrap max-width-600 mx-auto m-3">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Email Address:</strong> <span
                                                    id="overviewEmail"></span></li>
                                            <li class="list-group-item"><strong>Username:</strong> <span
                                                    id="overviewUsername"></span></li>
                                            <li class="list-group-item"><strong>Password:</strong> <span
                                                    id="overviewPassword"></span></li>
                                            <li class="list-group-item"><strong>Father Name:</strong> <span
                                                    id="overviewFatherName"></span></li>
                                            <li class="list-group-item"><strong>Full Name:</strong> <span
                                                    id="overviewFullName"></span></li>
                                            <li class="list-group-item"><strong>Address:</strong> <span
                                                    id="overviewAddress"></span></li>
                                            <li class="list-group-item"><strong>Phone Number:</strong> <span
                                                    id="overviewPhoneNumber"></span></li>
                                            <li class="list-group-item"><strong>CNIC:</strong> <span
                                                    id="overviewCNIC"></span></li>
                                            <li class="list-group-item"><strong>Designation:</strong> <span
                                                    id="overviewProgram"></span></li>
                                            <li class="list-group-item"><strong>Gender:</strong> <span
                                                    id="overviewCourses"></span></li>
                                        </ul>
                                    </div>
                                </section>
                                <button id="success-modal-btn" hidden data-toggle="modal" name="signup"
                                    data-target="#success-modal" data-backdrop="static">Launch modal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../Admin-pannel/vendors/scripts/core.js"></script>
    <script src="../Admin-pannel/vendors/scripts/script.min.js"></script>
    <script src="../Admin-pannel/vendors/scripts/process.js"></script>
    <script src="../Admin-pannel/vendors/scripts/layout-settings.js"></script>
    <script src="../Admin-pannel/src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="../Admin-pannel/vendors/scripts/steps-setting.js"></script>
    <script>
        function updateOverview() {
            document.getElementById("overviewEmail").textContent = document.querySelector('input[name="email"]').value;
            document.getElementById("overviewUsername").textContent = document.querySelector('input[name="username"]').value;
            document.getElementById("overviewPassword").textContent = document.querySelector('input[name="password"]').value;
            document.getElementById("overviewFatherName").textContent = document.querySelector('input[name="father-name"]').value;
            document.getElementById("overviewFullName").textContent = document.querySelector('input[name="f-name"]').value;
            document.getElementById("overviewAddress").textContent = document.querySelector('input[name="address"]').value;
            document.getElementById("overviewPhoneNumber").textContent = document.querySelector('input[name="phone"]').value;
            document.getElementById("overviewCNIC").textContent = document.querySelector('input[name="CNIC"]').value;
            document.getElementById("overviewProgram").innerText = document.querySelector("[name='designation']").options[document.querySelector("[name='designation']").selectedIndex].text;
            document.getElementById("overviewCourses").innerText = document.querySelector("[name='gender']").options[document.querySelector("[name='gender']").selectedIndex].text;
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            updateOverview();
        });
    </script>
</body>

</html>