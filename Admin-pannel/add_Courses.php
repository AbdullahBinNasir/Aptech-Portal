<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = '" . $_SESSION['email'] . " ';";

	$get_Pic = mysqli_query($connection, $profile);


	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {



			if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

				$name = $_POST['name'];
				$description = $_POST['description'];



				// if ($_FILES['image']['error'] == 4) {
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

						$newimgname = uniqid() . "." . $extension; //4545gh45rt454242.jpg
						// $insert = "INSERT INTO `courses`( `Course_Title`, `Description`, `image`) VALUES ('$name','$description','$newimgname')";
						$insert = "INSERT INTO `courses`( `Course_Title`, `Description`, `image`) VALUES ('$name','$description','$newimgname')";


						$result = mysqli_query($connection, $insert) or die("failed");
						if ($result) {
							move_uploaded_file($tmpname, "images/" . $newimgname);
							echo "<script>alert('Product registered succesfully')</script>";
						}
					}
				}
			}
?>


			<body>

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

				<!-- <div class="header-right">
					<div class="dashboard-setting user-notification">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
								<i class="dw dw-settings2"></i>
							</a>
						</div>
					</div>
					<div class="user-notification">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="icon-copy dw dw-notification"></i>
								<span class="badge notification-active"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="notification-list mx-h-350 customscroll">
									<ul>
										<li>
											<a href="#">
												<img src="vendors/images/img.jpg" alt="">
												<h3>John Doe</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo1.jpg" alt="">
												<h3>Lea R. Frith</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo2.jpg" alt="">
												<h3>Erik L. Richards</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo3.jpg" alt="">
												<h3>John Doe</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo4.jpg" alt="">
												<h3>Renee I. Hansen</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/img.jpg" alt="">
												<h3>Vicki M. Coleman</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="user-info-dropdown">
						<div class="dropdown">
							<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<span class="user-icon">
									<img src="vendors/images/photo1.jpg" alt="">
								</span>
								<span class="user-name">Ross C. Lopez</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
								<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
								<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
								<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
							</div>
						</div>
					</div>
					<div class="github-link">
						<a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg" alt=""></a>
					</div>
				</div>
				</div> -->

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
								<div class="container">
									<h1 class="text-center display-3 fw-semibold">Courses</h1>

									<form action="" method="post" enctype="multipart/form-data">
										<input class="form-control my-3" type="text" name="name" id="name" placeholder="Enter Course Name">
										<input class="form-control my-3" type="text" name="description" id="description" placeholder="Enter Description">
										<input class="form-control my-3" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
										<input class="form-control my-3 btn btn-success text-light" style="background-color: #202342;" type="submit" name="submit" value="ADD">
									</form>
								</div>
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