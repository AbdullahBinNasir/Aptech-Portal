<?php

// Start session
session_start();

// Database connection
require "../Connection/connection.php";
include "./Components/header.php";

// Initialize variables
$can_submit = false;

// Check if the user is logged in
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {

    // Get the user's profile details
    $profile = "SELECT u.*, u.user_id as studentid, s.*, b.*, emp.* 
                FROM users u 
                INNER JOIN students s ON u.email = s.email 
                INNER JOIN batches b ON s.batch_id = b.batch_id 
                LEFT JOIN employees emp ON u.email = emp.email 
                WHERE u.email = '" . $_SESSION['email'] . "';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        $data = mysqli_fetch_assoc($get_Pic);

        // Assuming student_id and faculty_id are stored in the database
        $student_id = $data['studentid'];
        $faculty_id = $data['assigned_faculty']; // Replace with actual faculty ID
        $bat_id = $data['batch_id'];

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
								

							<?php 

// Get the user's profile details
$gpa = "SELECT (AVG(total_gpa)) as Faculty_Batch_GPA from faculty_gpa where faculty_id = 88 AND batch_ID = 9;";
$get_gpa = mysqli_query($connection, $gpa);

if (mysqli_num_rows($get_gpa) > 0) {
	$data = mysqli_fetch_assoc($get_gpa); ?>
						
							  <h1>GPA Of Faculty: <?php echo $data['Faculty_Batch_GPA'] ?></h1>
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