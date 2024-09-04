<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.user_id as facultyid, u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";

	$get_Pic = mysqli_query($connection, $profile);


	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {


			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$batch_id = $_POST['batch_ID'];
				$faculty_id = $_POST['faculty_id'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				$due_date = $_POST['due_date'];

				$sql = "INSERT INTO assignments (batch_id, faculty_id, title, description, due_date)
						VALUES ('$batch_id', '$faculty_id', '$title', '$description', '$due_date')";

				if ($connection->query($sql) === TRUE) {
					echo "New assignment created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $connection->error;
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
								<form method="POST" action="">
									<!-- Course ID: <input type="text" name="course_id" required><br> -->

									<div class="form-group">
										<select name="batch_ID" id="batch_ID" class="form-control my-3 red-input">
											<option value="" disabled selected>Select Batch</option>
											<?php
											$getbatch = "SELECT * from `batches` where assigned_faculty = ".$data['facultyid'].";";
											$getbatch_run = mysqli_query($connection, $getbatch) or die("failed to get categories");
											if (mysqli_num_rows($getbatch_run) > 0) {
												while ($batch = mysqli_fetch_assoc($getbatch_run)) {
													echo '<option value="' . $batch['batch_id'] . '" >' . $batch['batch_name'] . '</option>';
												}
											}


											?>
									</div><br>
									
									<label for="Faculty ID">Faculty ID:</label><input type="hidden" name="faculty_id" placeholder="Faculty Id" required value="<?php echo $data['facultyid'] ?>" class="form-control my-3 red-input"><br>
									Title: <input type="text" name="title" required class="form-control my-3 red-input"><br>
									Description: <textarea name="description" class="form-control my-3 red-input"></textarea><br>
									Due Date: <input type="date" name="due_date" required class="form-control my-3 red-input"><br>
									<input type="submit" value="Create Assignment" class="btn btn-danger">
								</form>
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
// document.querySelector('input[name="Start_Date"]').setAttribute("min", today);
document.querySelector('input[name="due_date"]').setAttribute("min", today);
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
$connection->close();
?>