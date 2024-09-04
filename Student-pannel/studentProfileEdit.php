<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";

	$get_Pic = mysqli_query($connection, $profile);


	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {





			$usr_ID = $_GET['id'];


			$stdData = "SELECT s.*, u.* FROM students s INNER JOIN users u ON s.email = u.email WHERE u.user_id = '$usr_ID';";
			$res = mysqli_query($connection, $stdData) or die("fail to run query");

			if (mysqli_num_rows($res) == 1) {
				$row = mysqli_fetch_assoc($res);

				$name = $row['email'];
				$contact = $row['CNIC'];
				$city = $row['username'];



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


							<form action="StdApproval.php" method="post">
								<ul class="profile-edit-list row">
									<li class="weight-500 col-md-9">
										<h4 class="text-danger h5 mb-20">Student Profile</h4>
										<div class="form-group">
											<label>Full Name</label>
											<input class="form-control form-control-lg red-input" readonly type="text" name="up_fname" value="<?php echo $row['full_name'] ?>">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control form-control-lg red-input" readonly type="text" name="up_password" value="<?php echo $row['password'] ?>">
										</div>
										<div class="form-group">
											<label>Role</label>
											<input class="form-control form-control-lg red-input" readonly type="text" readonly value="<?php echo $row['role'] ?>">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg red-input" readonly type="email" name="email" readonly value="<?php echo $row['email'] ?>">
										</div>
										<!-- <div class="form-group">
											<label>Date of birth</label>
											<input class="form-control form-control-lg date-picker" name="up_dob" type="text" value="<?php echo $row['dob'] ?>">
										</div> -->
										<div class="form-group">
											<label>CNIC</label>
											<input class="form-control form-control-lg red-input" readonly name="up_CNIC" type="number" value="<?php echo $row['CNIC'] ?>">
										</div>
										<div class="form-group">
											<label>Gender</label>
											<div class="d-flex">
												<div class="custom-control custom-radio mb-5 mr-20">
													<input type="radio" id="customRadio4" readonly name="up_gender" value="male" class="custom-control-input " <?php if ($data['gender'] == "male") echo "checked"; ?>>
													<label class="custom-control-label weight-400" for="customRadio4">Male</label>
												</div>
												<div class="custom-control custom-radio mb-5">
													<input type="radio" id="customRadio5" readonly name="up_gender" value="female" class="custom-control-input" <?php if ($data['gender'] == "female") echo "checked"; ?>>
													<label class="custom-control-label weight-400" for="customRadio5">Female</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Phone Number</label>
											<input class="form-control form-control-lg red-input" readonly type="text" name="up_phone" value="<?php echo $row['phone_number'] ?>">
										</div>
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control red-input" readonly name="up_address"><?php echo $row['address'] ?></textarea>
										</div>
										<div class="form-group">
											<label>Assign Batch</label>
											<!-- <input class="form-control form-control-lg" readonly type="text" name="up_phone" value="<?php //echo $row['phone_number'] 
																																			?>"> -->

											<select name="batch_id" id="category_id" class="form-control my-3 red-input">
												<option value="" disabled selected>Choose category</option>
												<?php
												$getBatches = "SELECT * from `batches`;";
												$getBatches_run = mysqli_query($connection, $getBatches) or die("failed to get categories");
												if (mysqli_num_rows($getBatches_run) > 0) {
													while ($batch = mysqli_fetch_assoc($getBatches_run)) {
														$selected = ($batch['batch_id'] == $row['batch_id']) ? 'selected' : '';
														echo '<option value="' . $batch['batch_id'] . '" ' . $selected . '>' . $batch['batch_name'] . '</option>';
													}
												}


												?>

											</select>

										</div>
										<div class="form-group mb-0">
											<input type="submit" class="btn btn-warning" name="isApprove" value="Approve Student">
											<input type="submit" class="btn btn-danger" name="isDecline" value="Decline">

											<!-- <a href="students.php" class="btn btn-danger">Decline</a> -->
										</div>



									</li>
								</ul>
							</form>


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
?>