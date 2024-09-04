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



			if (isset($_POST['assign_project'])) {
				$group_id = $_POST['group_id'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				$assigned_date = date('Y-m-d');
				$due_date = $_POST['due_date'];

				// Handle file upload
				$attachment = '';
				if (!empty($_FILES['attachment']['name'])) {
					$attachment = basename($_FILES['attachment']['name']);
					$target_dir = "../uploads/";
					$target_file = $target_dir . $attachment;

					move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file);
				}

				// Insert project
				$insertProject = "INSERT INTO projects (group_id, title, description, attachment, assigned_date, due_date) 
								 VALUES ('$group_id', '$title', '$description', '$attachment', '$assigned_date', '$due_date')";
				if (mysqli_query($connection, $insertProject)) {
					echo "Project assigned successfully!";
				} else {
					echo "Error: " . mysqli_error($connection);
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
								<form method="POST" action="" enctype="multipart/form-data">
									<label for="group_id">Select Group:</label>
									<select name="group_id" id="group_id" required>
										<!-- Fetch and list groups from the database -->
									</select>

									<label for="title">Project Title:</label>
									<input type="text" name="title" id="title" required>

									<label for="description">Project Description:</label>
									<textarea name="description" id="description" required></textarea>

									<label for="due_date">Due Date:</label>
									<input type="date" name="due_date" id="due_date" required>

									<label for="attachment">Attachment:</label>
									<input type="file" name="attachment" id="attachment">

									<button type="submit" name="assign_project">Assign Project</button>
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