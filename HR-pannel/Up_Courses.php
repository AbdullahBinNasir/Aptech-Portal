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

				$getdata = "SELECT * FROM `courses` WHERE Course_id='$id';";

				$result = mysqli_query($connection, $getdata) or die("fail to run query");

				if (mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_assoc($result);

					$name = $row['Course_Title'];
					$descripton = $row['Description'];
					$image = $row['image'];



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
											<form action="upCrsData.php" method="post" class="form-group" enctype="multipart/form-data">
												<input type="hidden" name="id" id="" class="form-control red-input my-2" value="<?php echo $id ?>">
												<input type="text" name="course_name" id="" class="form-control  red-input my-2" placeholder="Enter Course name" value="<?php echo $name ?>">
												<input type="text" name="Description" id="" class="form-control red-input my-2" placeholder="Enter Description Date" value="<?php echo $descripton ?>">
												<input type="file" name="image" id="" class="form-control red-input my-2" placeholder="Upload Image" value="<?php echo $image ?>">
												<input type="submit" name="Add" id="" class="form-control btn btn-danger my-2 text-light" >
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
	}
}

?>