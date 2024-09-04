<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	$profile = "SELECT u.user_id as facultyid, u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";
	$get_Pic = mysqli_query($connection, $profile);

	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {
			// Handle POST request and batch_id check inside the body
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
								<form method="POST" action="">
									<div class="form-group">
										<select name="batch_id" id="batch_id" class="form-control my-3 red-input">
											<option value="" disabled <?php echo !isset($_POST['batch_id']) ? 'selected' : ''; ?>>Select Batch</option>
											<?php
											$getbatch = "SELECT * FROM `batches` WHERE assigned_faculty = " . $data['facultyid'] . ";";
											$getbatch_run = mysqli_query($connection, $getbatch) or die("Failed to get categories");

											if (mysqli_num_rows($getbatch_run) > 0) {
												while ($batch = mysqli_fetch_assoc($getbatch_run)) {
													// Check if this option should be selected
													$selected = (isset($_POST['batch_id']) && $_POST['batch_id'] == $batch['batch_id']) ? 'selected' : '';
													echo '<option value="' . $batch['batch_id'] . '" ' . $selected . '>' . $batch['batch_name'] . '</option>';
												}
											}
											?>
										</select>
									</div>
									<input type="submit" value="View Grades" class="btn btn-danger mt-3">
								</form>


								<?php
								if ($_SERVER['REQUEST_METHOD'] == 'POST') {
									$batch_id = $_POST['batch_id'];

									// Check if the batch_id exists
									$batch_check = "SELECT COUNT(*) as count FROM assignments WHERE batch_id = '$batch_id'";
									$batch_result = $connection->query($batch_check);
									$batch_row = $batch_result->fetch_assoc();

									if ($batch_row['count'] > 0) {
										// If batch_id exists, fetch the data
										$sql = "SELECT s.submission_id, st.student_id, u.full_name AS student_name, a.title AS assignment_title, 
                                                   s.marks, s.feedback
                                            FROM submissions s
                                            INNER JOIN assignments a ON s.assignment_id = a.assignment_id
                                            INNER JOIN students st ON s.student_id = st.student_id
                                            INNER JOIN users u ON st.email = u.email
                                            WHERE a.batch_id = '$batch_id'";

										$result = $connection->query($sql);

										if ($result->num_rows > 0) {

											echo "<div class='container mt-5'>
                                                <h2 class='mb-4'>Grades for Batch: $batch_id</h2>
                                                <table class='table table-bordered table-striped'>
                                                <thead class='thead-dark'>
                                                    <tr>
                                                        <th>Submission ID</th>
                                                        <th>Student ID</th>
                                                        <th>Student Name</th>
                                                        <th>Assignment Title</th>
                                                        <th>Marks</th>
                                                        <th>Feedback</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";

											while ($row = $result->fetch_assoc()) {
												echo "<tr>
                                                    <td>{$row['submission_id']}</td>
                                                    <td>{$row['student_id']}</td>
                                                    <td>{$row['student_name']}</td>
                                                    <td>{$row['assignment_title']}</td>
                                                    <td>{$row['marks']}</td>
                                                    <td>{$row['feedback']}</td>
                                                  </tr>";
											}

											echo "</tbody>
                                              </table>
                                              </div>";
										} else {
											echo "<div class='container mt-5'><p class='alert alert-warning'>No grades available for this batch.</p></div>";
										}
									} else {
										echo "<div class='container mt-5'><p class='alert alert-danger'>Invalid Batch ID. Please try again.</p></div>";
									}
								}
								?>
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
$connection->close();
?>