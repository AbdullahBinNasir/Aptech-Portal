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
			// header Ends here 




			if (isset($_Post['UpdateSbtn'])) {

				// $username = mysqli_real_escape_string($connection, $_POST['username']);
				// $father_Name = mysqli_real_escape_string($connection, $_POST['father-name']);
				// $father_Occupation = mysqli_real_escape_string($connection, $_POST['father-occupation']);
				$Up_fullName = mysqli_real_escape_string($connection, $_POST['up_fname']);
				$Up_email = mysqli_real_escape_string($connection, $_POST['up_email']);
				$Up_password = mysqli_real_escape_string($connection, $_POST['up_password']);
				$Up_cont_Number = mysqli_real_escape_string($connection, $_POST['up_phone']);
				$Up_address = mysqli_real_escape_string($connection, $_POST['up_address']);
				// $guardian_Number = mysqli_real_escape_string($connection, $_POST['f-phone']);
				$Up_CNIC = mysqli_real_escape_string($connection, $_POST['up_CNIC']);
				$Up_dateofbirth = mysqli_real_escape_string($connection, $_POST['up_dob']);
				$Up_gender = mysqli_real_escape_string($connection, $_POST['up_gender']);
				// $program = mysqli_real_escape_string($connection, $_POST['program']);
				// $courses = mysqli_real_escape_string($connection, $_POST['courses']);


				$upd_profile = "UPDATE `users` set `full_name`='$Up_fullName',`password`='$Up_password',`phone_number`='$Up_cont_Number', `address`='$Up_address',`gender`='$Up_gender'   WHERE u.email = '" . $_SESSION['email'] . " ';";
				$upd_User_Profile = mysqli_query($connection, $upd_profile);

				if ($upd_User_Profile) {
					echo "<script>alert('Student`s Details Updated.')</script>;";
					header("location: profile.php");
				} else {
					echo "<script>alert('Sorry, Failed to update this record.')</script>";
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
					<link rel="stylesheet" href="./src/styles/style1.css">
					<!-- Breadcrumbs starts here -->
					<div class="pd-ltr-20 xs-pd-20-10">
						<div class="min-height-200px">
							<div class="page-header">
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="title">
											<h4>Profile</h4>
										</div>
										<nav aria-label="breadcrumb" role="navigation">
											<ol class="breadcrumb">
												<li class="breadcrumb-item"><a href="adminDashboard.php">Home</a></li>
												<li class="breadcrumb-item active" aria-current="page" style="color: red;">Profile</li>
											</ol>
										</nav>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
									<div class="pd-20 card-box height-100-p">
										<div class="profile-photo">
											<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
											<img src="../Auth/images/<?php echo $data['Profile']; ?>" alt="" class="avatar-photo">
											<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<form action="imageupdate.php" method="post" enctype="multipart/form-data">

															<div class="modal-body pd-5">
																<div class="img-container">
																	<img id="image" src="../Auth/images/<?php echo $data['Profile']; ?>" alt="Picture">
																</div>
																<input type="text" name="adm_email" value="<?php echo $data['email'] ?>" hidden readonly>
																<input class="form-control my-3" type="file" name="image" id="image2" accept=".jpg, .png, .jpeg">
															</div>
															<div class="modal-footer">
																<input type="submit" value="Update" name="imgUpdate" class="btn btn-warning">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<h5 class="text-center h5 mb-0"><?php echo $data['full_name']; ?></h5>
										<p class="text-center text-muted font-14"><?php echo $data['role']; ?></p>
										<div class="profile-info">
											<h5 class="mb-20 h5 text-danger">Contact Information</h5>
											<ul>
												<li>
													<span class="text-danger">Email Address:</span>
													<?php echo $data['email']; ?>
												</li>
												<li>
													<span class="text-danger">Phone Number:</span>
													<?php echo $data['phone_number']; ?>
												</li>
												<li>
													<span class="text-danger">CNIC</span>
													<?php echo $data['cnic']; ?>
												</li>
												<li>
													<span class="text-danger">Address:</span>
													<?php echo $data['address']; ?>
												</li>
											</ul>
										</div>
										<!-- <div class="profile-social">
											<h5 class="mb-20 h5 text-blue">Social Links</h5>
											<ul class="clearfix">
												<li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fa fa-dribbble"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="fa fa-dropbox"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i class="fa fa-pinterest-p"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-skype"></i></a></li>
												<li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i class="fa fa-vine"></i></a></li>
											</ul>
										</div> -->
										<div class="profile-skills">
											<h5 class="mb-20 h5 text-danger">Key Skills</h5>
											<h6 class="mb-5 font-14">Managment</h6>
											<div class="progress mb-20" style="height: 6px;">
												<div class="progress-bar" role="progressbar" style="width: 90%; background-Color:red" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<h6 class="mb-5 font-14">Organizational Skills</h6>
											<div class="progress mb-20" style="height: 6px;">
												<div class="progress-bar" role="progressbar" style="width: 70%; background-Color:red" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<h6 class="mb-5 font-14">Customer Service</h6>
											<div class="progress mb-20" style="height: 6px;">
												<div class="progress-bar" role="progressbar" style="width: 60%; background-Color:red" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
											<h6 class="mb-5 font-14">Problem Solving</h6>
											<div class="progress mb-20" style="height: 6px;">
												<div class="progress-bar" role="progressbar" style="width: 80%; background-Color:red" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
									<div class="card-box height-100-p overflow-hidden">
										<div class="profile-tab height-100-p">
											<div class="tab height-100-p">
												<ul class="nav nav-tabs customtab" role="tablist">
													<li class="nav-item">
														<a class="nav-link active text-danger" style="border-bottom: 2px solid red" data-toggle="tab" href="#setting" role="tab">Settings</a>
													</li>
													<!-- <li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Tasks</a>
													</li> -->
												</ul>
												<div class="tab-content">

													<!-- Tasks Tab start -->
													<div class="tab-pane fade" id="tasks" role="tabpanel">
														<div class="pd-20 profile-task-wrap">
															<div class="container pd-0">
																<!-- Open Task start -->
																<div class="task-title row align-items-center">
																	<div class="col-md-8 col-sm-12">
																		<h5>Open Tasks (4 Left)</h5>
																	</div>
																	<div class="col-md-4 col-sm-12 text-right">
																		<a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
																	</div>
																</div>
																<div class="profile-task-list pb-30">
																	<ul>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-1">
																				<label class="custom-control-label" for="task-1"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div>
																			</div>
																		</li>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-2">
																				<label class="custom-control-label" for="task-2"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div>
																			</div>
																		</li>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-3">
																				<label class="custom-control-label" for="task-3"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet, consectetur adipisicing elit.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div>
																			</div>
																		</li>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-4">
																				<label class="custom-control-label" for="task-4"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet. Id ea earum.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div>
																			</div>
																		</li>
																	</ul>
																</div>
																<!-- Open Task End -->
																<!-- Close Task start -->
																<div class="task-title row align-items-center">
																	<div class="col-md-12 col-sm-12">
																		<h5>Closed Tasks</h5>
																	</div>
																</div>
																<div class="profile-task-list close-tasks">
																	<ul>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-close-1" checked="" disabled="">
																				<label class="custom-control-label" for="task-close-1"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div>
																			</div>
																		</li>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-close-2" checked="" disabled="">
																				<label class="custom-control-label" for="task-close-2"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div>
																			</div>
																		</li>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-close-3" checked="" disabled="">
																				<label class="custom-control-label" for="task-close-3"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet, consectetur adipisicing elit.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div>
																			</div>
																		</li>
																		<li>
																			<div class="custom-control custom-checkbox mb-5">
																				<input type="checkbox" class="custom-control-input" id="task-close-4" checked="" disabled="">
																				<label class="custom-control-label" for="task-close-4"></label>
																			</div>
																			<div class="task-type">Email</div>
																			Lorem ipsum dolor sit amet. Id ea earum.
																			<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div>
																			</div>
																		</li>
																	</ul>
																</div>
																<!-- Close Task start -->
																<!-- add task popup start -->
																<div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
																	<div class="modal-dialog modal-dialog-centered" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLongTitle">Tasks Add</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
																					<span aria-hidden="true">&times;</span>
																				</button>
																			</div>
																			<div class="modal-body pd-0">
																				<div class="task-list-form">
																					<ul>
																						<li>
																							<form>
																								<div class="form-group row">
																									<label class="col-md-4">Task Type</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control">
																									</div>
																								</div>
																								<div class="form-group row">
																									<label class="col-md-4">Task Message</label>
																									<div class="col-md-8">
																										<textarea class="form-control"></textarea>
																									</div>
																								</div>
																								<div class="form-group row">
																									<label class="col-md-4">Assigned to</label>
																									<div class="col-md-8">
																										<select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text="{0} people selected">
																											<option>Ferdinand M.</option>
																											<option>Don H. Rabon</option>
																											<option>Ann P. Harris</option>
																											<option>Katie D. Verdin</option>
																											<option>Christopher S. Fulghum</option>
																											<option>Matthew C. Porter</option>
																										</select>
																									</div>
																								</div>
																								<div class="form-group row mb-0">
																									<label class="col-md-4">Due Date</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control date-picker">
																									</div>
																								</div>
																							</form>
																						</li>
																						<li>
																							<a href="javascript:;" class="remove-task" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
																							<form>
																								<div class="form-group row">
																									<label class="col-md-4">Task Type</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control">
																									</div>
																								</div>
																								<div class="form-group row">
																									<label class="col-md-4">Task Message</label>
																									<div class="col-md-8">
																										<textarea class="form-control"></textarea>
																									</div>
																								</div>
																								<div class="form-group row">
																									<label class="col-md-4">Assigned to</label>
																									<div class="col-md-8">
																										<select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text="{0} people selected">
																											<option>Ferdinand M.</option>
																											<option>Don H. Rabon</option>
																											<option>Ann P. Harris</option>
																											<option>Katie D. Verdin</option>
																											<option>Christopher S. Fulghum</option>
																											<option>Matthew C. Porter</option>
																										</select>
																									</div>
																								</div>
																								<div class="form-group row mb-0">
																									<label class="col-md-4">Due Date</label>
																									<div class="col-md-8">
																										<input type="text" class="form-control date-picker">
																									</div>
																								</div>
																							</form>
																						</li>
																					</ul>
																				</div>
																				<div class="add-more-task">
																					<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Task"><i class="ion-plus-circled"></i> Add More Task</a>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-primary">Add</button>
																				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- add task popup End -->
															</div>
														</div>
													</div>
													<!-- Tasks Tab End -->
													<!-- Setting Tab start -->
													<div class="tab-pane fade show active height-100-p" id="setting" role="tabpanel">
														<div class="profile-setting">
															<form action="updatedata.php" method="post">
																<ul class="profile-edit-list row">
																	<li class="weight-500 col-md-9">
																		<h4 class="text-danger h5 mb-20">Edit Your Personal Setting</h4>
																		<div class="form-group">
																			<label>Full Name</label>
																			<input class="form-control form-control-lg red-input" type="text" name="up_fname" value="<?php echo $data['full_name'] ?>">
																		</div>
																		<div class="form-group">
																			<label>Password</label>
																			<input class="form-control form-control-lg red-input" type="text" name="up_password" value="<?php echo $data['password'] ?>">
																		</div>
																		<div class="form-group">
																			<label>Role</label>
																			<input class="form-control form-control-lg red-input" type="text" readonly value="<?php echo $data['role'] ?>">
																		</div>
																		<div class="form-group">
																			<label>Email</label>
																			<input class="form-control form-control-lg red-input" type="email" name="email" readonly value="<?php echo $data['email'] ?>">
																		</div>
																		<div class="form-group">
																			<label>Date of birth</label>
																			<input class="form-control form-control-lg  red-input" id="DOB" name="up_dob" type="date" value="<?php echo $data['dob'] ?>">
																		</div>
																		<div class="form-group">
																			<label>CNIC</label>
																			<input class="form-control form-control-lg  red-input" name="up_CNIC" type="number" value="<?php echo $data['cnic'] ?>">
																		</div>
																		<div class="form-group">
																			<label>Gender</label>
																			<div class="d-flex">
																				<div class="custom-control custom-radio mb-5 mr-20">
																					<input type="radio" id="customRadio4" name="up_gender"  value="male"  class="custom-control-input" style="background-color: red;" <?php if ($data['gender'] == "male") echo "checked"; ?>>
																					<label class="custom-control-label weight-400" for="customRadio4">Male</label>
																				</div>
																				<div class="custom-control custom-radio mb-5">
																					<input type="radio" id="customRadio5"  name="up_gender" value="female" class="custom-control-input back" <?php if ($data['gender'] == "female") echo "checked"; ?>>
																					<label class="custom-control-label weight-400" for="customRadio5">Female</label>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label>Phone Number</label>
																			<input class="form-control form-control-lg red-input" type="text" name="up_phone" value="<?php echo $data['phone_number'] ?>">
																		</div>
																		<div class="form-group">
																			<label>Address</label>
																			<textarea class="form-control red-input" name="up_address"><?php echo $data['address'] ?></textarea>
																		</div>
																		<div class="form-group mb-0">
																			<input type="submit" class="btn btn-danger" name="UpdateSbtn" value="Update Information">
																		</div>
																	</li>
																</ul>
															</form>
														</div>
													</div>
													<!-- Setting Tab End -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Footer Starts Here -->
						<?php
						include "./Components/footer.php";
						?>
						<!-- Footer Ends Here -->
					</div>
					<!-- Breadcrumbs starts here -->
				</div>

				<script>
					let yesterday = new Date();
yesterday.setDate(yesterday.getDate() - 1);
let maxDate = yesterday.toISOString().split('T')[0];

// Set the maximum date for the "Date of Birth"
document.getElementById('DOB').setAttribute("max", maxDate);
				</script>
				<!-- js -->
				<script src="vendors/scripts/core.js"></script>
				<script src="vendors/scripts/script.min.js"></script>
				<script src="vendors/scripts/process.js"></script>
				<script src="vendors/scripts/layout-settings.js"></script>
				<script src="src/plugins/cropperjs/dist/cropper.js"></script>
				<!-- <script>
					window.addEventListener('DOMContentLoaded', function() {
						var image = document.getElementById('image');
						var cropBoxData;
						var canvasData;
						var cropper;

						$('#modal').on('shown.bs.modal', function() {
							cropper = new Cropper(image, {
								autoCropArea: 0.5,
								dragMode: 'move',
								aspectRatio: 3 / 3,
								restore: false,
								guides: false,
								center: false,
								highlight: false,
								cropBoxMovable: false,
								cropBoxResizable: false,
								toggleDragModeOnDblclick: false,
								ready: function() {
									cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
								}
							});
						}).on('hidden.bs.modal', function() {
							cropBoxData = cropper.getCropBoxData();
							canvasData = cropper.getCanvasData();
							cropper.destroy();
						});
					});
				</script> -->
			</body>

			</html>

<?php

		}
	}
}

?>