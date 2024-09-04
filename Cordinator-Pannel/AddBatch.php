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


			if (isset($_POST['stddata'])) {
				$batch_name = $_POST['Batch_Name'];
				$start_date = $_POST['Start_Date'];
				$end_date = $_POST['End_Date'];
				$ass_faculty = $_POST['faculty_ID'];

				$insert = "INSERT INTO `batches`(`batch_name`, `start_date`, `end_date`, `assigned_faculty`) values ('$batch_name', '$start_date', '$end_date','$ass_faculty');";

				$result = mysqli_query($connection, $insert) or die("Failed to insert query");

				if ($result) {

					echo "<script>alert('Batch details added succesfully...')</script>";
					header("location: ViewBatch.php");
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
									<h1 class="text-center">Add Batches</h1>

									<form action="" method="post" class="form-group">

										<div class="form-group">
											<label for="Batch_Name">Enter Batch Name</label>
											<input type="text" name="Batch_Name" class="form-control my-2 red-input" placeholder="Enter Batch Name">
										</div>

										<div class="form-group">
											<div class="form-group">
												<label for="Batch_Name">Enter Batch Start Date</label>
												<input type="date" name="Start_Date" class="form-control my-2 red-input" placeholder="Enter Start Date">
											</div>

											<div class="form-group">
												<label for="Batch_Name">Enter Batch End Date</label>
												<input type="date" name="End_Date" class="form-control my-2 red-input" placeholder="Enter End Date">
											</div>

											<div class="form-group">
												<select name="faculty_ID" id="faculty_ID" class="form-control my-3 red-input">
													<option value="" disabled selected>Choose Faculty</option>
													<?php
													$getfaculty = "SELECT e.*, u.* FROM employees e INNER JOIN users u ON e.email = u.email  where `designation`= 'Faculty' and `is_approved` = 1 ;";
													$getfaculty_run = mysqli_query($connection, $getfaculty) or die("failed to get categories");
													if (mysqli_num_rows($getfaculty_run) > 0) {
														while ($faculty = mysqli_fetch_assoc($getfaculty_run)) {
															echo '<option value="' . $faculty['user_id'] . '" >' . $faculty['full_name'] . '</option>';
														}
													}


													?>
											</div>

											<input type="submit" value="Submit Form" name="stddata" class="form-control btn btn-danger my-2 text-light" >

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