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


			if ($_GET['id']) {
				$id = $_GET['id'];

				$getdata = "SELECT * FROM `batches` WHERE batch_id='$id';";

				$result = mysqli_query($connection, $getdata) or die("fail to run query");

				if (mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_assoc($result);

					$name = $row['batch_name'];
					$start_date = $row['start_date'];
					$end_date = $row['end_date'];


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
										<div class="container my-4">
											<h1 class="text-center">Enter Batch Details</h1>
											<form action="UpdateBatchData.php" method="post" class="form-group">
												<input type="hidden" name="id" id="" class="form-control my-2 red-input" value="<?php echo $id ?>">

												<div class="form-group">
													<label for="Batch_Name">Enter Batch Name</label>
													<input type="text" name="batch_name" id="Batch_Name" class="form-control my-2 red-input" placeholder="Enter batch name" value="<?php echo $name ?>">
												</div>

												<div class="form-group">
												<label for="Batch_Sdate">Enter Batch Start Date</label>
													<input type="date" name="start_date" id="Batch_Sdate" class="form-control my-2 red-input" placeholder="Enter Start Date" value="<?php echo $start_date ?>">
												</div>

												<div class="form-group">
												<label for="Batch_Edate">Enter Batch End Date</label>
													<input type="date" name="end_date" id="Batch_Edate" class="form-control my-2 red-input" placeholder="Enter End Date" value="<?php echo $end_date ?>">
												</div>

												<div class="form-group">
												<select name="faculty_ID" id="faculty_ID" class="form-control my-3">
													<option value="" disabled selected>Choose Faculty</option>
													<?php
													$getfaculty = "SELECT e.*, u.* FROM employees e INNER JOIN users u ON e.email = u.email  where `designation`= 'Faculty' and `is_approved` = 1 ;";
													$getfaculty_run = mysqli_query($connection, $getfaculty) or die("failed to get categories");
													if (mysqli_num_rows($getfaculty_run) > 0) {
														while ($faculty = mysqli_fetch_assoc($getfaculty_run)) {

															$selected = ($faculty['user_id'] == $row['assigned_faculty']) ? 'selected' : '';
															echo '<option value="' . $faculty['user_id'] . '" ' . $selected . '>' . $faculty['full_name'] . '</option>';
															
															
														}
													}
// '. if ($faculty['user_id'] == $row['assigned_faculty']) echo "selected"; '

													?>
											</div>


												<input type="submit" name="Add" id="" class="form-control btn btn-danger my-2 text-light">
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

						<script>
                                   // Get today's date in YYYY-MM-DD format
                                   let today = new Date().toISOString().split('T')[0];
                                   
                                   // Set the minimum date for the "Batch Start Date" and "Batch End Date"
                                   document.getElementById('Batch_Sdate').setAttribute("min", today);
                                   document.getElementById('Batch_Edate').setAttribute("min", today);
                                   </script>
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
	}
} else {
	echo "id not found";
}

?>