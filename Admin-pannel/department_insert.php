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




			if (isset($_POST['depdata'])) {
				$name = $_POST['name'];
				$head = $_POST['head'];
				$location = $_POST['location'];
				$contact = $_POST['contact'];

				$insert = "INSERT INTO `departments`(`department_name`,`head_of_department`,`location`, `contact_details`) values ('$name', '$head', '$location','$contact');";
				$result = mysqli_query($connection, $insert);

				if ($result) {

					echo "<script>alert('Student details added succesfully...')</script>";
				} else {

					echo "<script>alert('Failed to insert data.. ')</script>";
				}
			}



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
								<div class="container">
									<h1 class="text-center">Department</h1>

									<form action="" method="post" class="form-group">

										<div class="form-group">
											<label for="name">Enter Department Name</label>
											<input type="text" name="name" class="form-control my-2 red-input" placeholder="Enter Department Name">
										</div>

										<div class="form-group">



											<div class="form-group">
												<label for="head">Enter Head Of Department </label>
												<select name="head" id="head" class="form-control red-input">
													<!-- <option value="" selected>ADMIN</option> -->
													<!-- <option value="" >HR</option> -->
													<?php

													$getorganizer = "SELECT * FROM users 
													WHERE is_approved = 1 
													AND (role = 'Employee' OR role = 'HR' OR role = 'Admin');";
													$getorganizer_run = mysqli_query($connection, $getorganizer) or die("failed to get categories");
													if (mysqli_num_rows($getorganizer_run) > 0) {
														while ($organizer = mysqli_fetch_assoc($getorganizer_run)) {
															echo '<option value="' . $organizer['user_id'] . '" >' . $organizer['full_name'] . '</option>';
														}
													}
													?>
												</select>
											</div>

											<div class="form-group">
												<label for="location">Enter Department location </label>
												<input type="text" name="location" class="form-control my-2 red-input" placeholder="Enter Department location ">
											</div>
											<div class="form-group">
												<label for="Contact">Enter Contact Details </label>
												<input type="number" name="contact" class="form-control my-2 red-input" placeholder="Enter Contact Details ">
											</div>

											<input type="submit" value="Submit Form" name="depdata" class="form-control btn btn-danger my-2 text-light">

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