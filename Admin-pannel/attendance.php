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



			$batches = [];
			$students = [];
			$selected_batch_id = null;
			$message = "";

			// Fetch batches
			$sql = "SELECT * FROM batches";
			$result = $connection->query($sql);
			while ($row = $result->fetch_assoc()) {
				$batches[] = $row;
			}

			// Handle form submission
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (isset($_POST['select_batch'])) {
					$selected_batch_id = $_POST['batch_id'];

					// Fetch students for the selected batch
					$sql = "SELECT s.*, u.* FROM students s INNER JOIN users u ON s.email = u.email WHERE batch_id = $selected_batch_id";
					$result = $connection->query($sql);
					while ($row = $result->fetch_assoc()) {
						$students[] = $row;
					}
				} elseif (isset($_POST['mark_attendance'])) {
					$student_ids = $_POST['student_ids'];
					$selected_Bth_ids = $_POST['bth_ids'];
					$date = date("Y-m-d");

					foreach ($student_ids as $student_id) {
						$status = $_POST["status_$student_id"];
						$sql = "INSERT INTO attendance (`student_id`,`batch_id`, `attendance_date`, status) VALUES ($student_id, $selected_Bth_ids , '$date', '$status')";
						$connection->query($sql);
					}
					$message = "Attendance marked successfully!";
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
								<h1>Mark Attendance</h1>

								<!-- Display success message -->
								<?php if ($message) {
									echo "<p>$message</p>";
								} ?>

								<!-- Batch selection form -->
								<form method="post">
									<h2 class="mt-5">Select Batch</h2>
									<select name="batch_id" class="form-control my-3">
										<?php foreach ($batches as $batch) { ?>
											<option value="<?php echo $batch['batch_id']; ?>" <?php if ($selected_batch_id == $batch['batch_name']) echo 'selected'; ?>><?php echo $batch['batch_name']; ?></option>
										<?php } ?>
									</select>
									<input type="submit" name="select_batch" value="View Students" class="btn btn-danger">
								</form>

								<!-- Display students if a batch is selected -->
								<?php if ($students) { ?>
									<form method="post">
										<h2 class="mt-5">Students in Batch</h2>
										<table class="data-table table stripe hover nowrap mt-5">
											<tr>
												<th class="table-plus datatable-nosort">Student Name</th>
												<th class="datatable-nosort">Status</th>
											</tr>
											<?php foreach ($students as $student) { ?>
												<tr>
													<td class="table-plus"><?php echo $student['full_name']; ?></td>
													<td>
														<input type="hidden" name="student_ids[]" value="<?php echo $student['student_id']; ?>">
														<input type="hidden" name="bth_ids" value="<?php echo $student['batch_id']; ?>">
														
														<select class='form-control' name="status_<?php echo $student['student_id']; ?> ">
															<option value="Present" >Present</option>
															<option value="Absent">Absent</option>
														</select>
													</td>
												</tr>
											<?php } ?>
										</table>
										<input type="submit" name="mark_attendance" value="Submit Attendance" class="btn btn-danger">
									</form>
								<?php } ?>
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