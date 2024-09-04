
<?php
// include ("../Connection/header.php");
require ("../Connection/connection.php");
if (isset($_POST['signin']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $check = "SELECT * FROM users WHERE email='$email';";
    $result = mysqli_query($connection, $check) or die("failed to insert query.");
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $regUsername = $row['username'];
            $regEmail = $row['email'];
            $regPass = $row['password'];//hash
            $verifyPass = password_verify($password, $regPass);
			$isApproved = $row['is_approved'];

            $role = "SELECT * FROM users  ";
            $res = mysqli_query($connection, $role) or die("failed to insert query");


            if ($verifyPass) {
                session_start();
                $_SESSION['email'] = $regEmail;
                $_SESSION['username'] = $regUsername;
                if ($res) {
                    if (mysqli_num_rows($res) > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            if ($row['role'] == 'Employee' && $row['is_approved'] == 1) {
                                echo "<script>alert('Successfully logged in.')
                                window.location.href='../Employee_pannel/faculty_Dashboard.php' ;</script>";
                            }
							
                            elseif ($row['role'] == 'Employee' && $row['is_approved'] == 0) {
                                echo "<script>alert('Approval IS Pending.')
								window.location.href='logIn.php';</script>";
                            }

                            elseif ($row['role'] == 'Employee' && $row['is_approved'] == 3) {
                                echo "<script>alert('Approval Declined By Admin..')
								window.location.href='logIn.php';</script>";
                            }
							
							
							elseif ($row['role'] == 'Student' && $row['is_approved'] == 1) {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='../Student-pannel/Student-dashboard.php';</script>";
                            }

							elseif ($row['role'] == 'Student' && $row['is_approved'] == 0) {
                                echo "<script>alert('Approval IS Pending.')
								window.location.href='logIn.php';</script>";
                               
                            }

							elseif ($row['role'] == 'Student' && $row['is_approved'] == 3) {
                                echo "<script>alert('Approval Declined By Admin.')
								window.location.href='logIn.php';</script>";
                               
                            } 
							elseif ($row['role'] == 'Coordinator' && $row['is_approved'] == 1) {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='../Cordinator-Pannel/Coordinator_Dashboard.php';</script>";
                            }

							elseif ($row['role'] == 'Coordinator' && $row['is_approved'] == 0) {
                                echo "<script>alert('Approval IS Pending.')
								window.location.href='logIn.php';</script>";
                               
                            }

							elseif ($row['role'] == 'Coordinator' && $row['is_approved'] == 3) {
                                echo "<script>alert('Approval Declined By Admin.')
								window.location.href='logIn.php';</script>";
                               
                            } 
							
							
							elseif ($row['role'] == 'HR' && $row['is_approved'] == 1) {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='../HR-pannel/HR_Dashboard.php' ;</script>";
                            }

							elseif ($row['role'] == 'HR' && $row['is_approved'] == 0) {
                                echo "<script>alert('Approval IS Pending.')
								window.location.href='logIn.php';</script>";
                             
                            }


							elseif ($row['role'] == 'Admin' && $row['is_approved'] == 1) {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='../Admin-pannel/adminDashboard.php';</script>";
                            }

							elseif ($row['role'] == 'Admin' && $row['is_approved'] == 0) {
                                echo "<script>alert('Approval IS Pending.')
								window.location.href='logIn.php';</script>"; 
                                
                            }
                        }
                    }

                }

            } else {
                echo "<script>alert('Invalid Credentials.')</script>;";
            }
        } else {
            echo "<script>alert('Pehle account bana kr aao.')
       window.location.href='signup.php';</script>;";
        }
    }
}


?>


<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Aptech Portal - Aptech Digital Campus</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../Admin-pannel/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../Admin-pannel/vendors/images/Aptech-Favicon.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../Admin-pannel/vendors/images/Aptech-Favicon.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../Admin-pannel/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../Admin-pannel/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../Admin-pannel/vendors/styles/style.css">
	<link rel="stylesheet" href="../Admin-pannel/src/styles/style1.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo my-3">
				<a href="logIn.php">
					<img src="../Admin-pannel/vendors/images/apt_logo.png"  alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="SignUp.php" class="text-danger">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="../Admin-pannel/vendors/images/login1.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						 <div class="login-title">
							<h2 class="text-center text-danger">Login To Aptech Portal</h2>
						</div>
						<form action="" method="post" class="form-group">
							<div class="select-role">
								<!-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="../Admin-pannel/vendors/images/briefcase.png" class="svg" alt=""></div>
										<span>I'm</span>
										Student
									</label>
									<label class="btn">
										<input type="radio"  name="options" id="user">
										<div class="icon"><img src="../Admin-pannel/vendors/images/person.png" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label>
								</div> -->
							</div> 
							<!-- <div class="input-group custom">
								<input type="text" name="username" class="form-control form-control-lg red-input" placeholder="Username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div> -->
							<div class="input-group custom">
								<input type="email" name="email" class="form-control form-control-lg red-input" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg red-input" placeholder="Password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox"  class="custom-control-input" id="customCheck1">
										<label class="custom-control-label"  for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgetpass.php">Forgot Password</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<!-- <div class="input-group mb-0"> -->
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<!-- <a class="btn btn-primary btn-lg btn-block" name="signin">Sign In</a> -->
										<input type="submit"  name="signin" id="" class="form-control btn btn-danger text-light my-2 ">
									<!-- </div> -->
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-danger btn-lg btn-block" href="SignUp.php">Register To Create Account</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="../Admin-pannel/vendors/scripts/core.js"></script>
	<script src="../Admin-pannel/vendors/scripts/script.min.js"></script>
	<script src="../Admin-pannel/vendors/scripts/process.js"></script>
	<script src="../Admin-pannel/vendors/scripts/layout-settings.js"></script>
</body>
</html>