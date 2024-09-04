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

				<!-- <div class="header-right">
					<div class="dashboard-setting user-notification">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
								<i class="dw dw-settings2"></i>
							</a>
						</div>
					</div>
					<div class="user-notification">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="icon-copy dw dw-notification"></i>
								<span class="badge notification-active"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="notification-list mx-h-350 customscroll">
									<ul>
										<li>
											<a href="#">
												<img src="vendors/images/img.jpg" alt="">
												<h3>John Doe</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo1.jpg" alt="">
												<h3>Lea R. Frith</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo2.jpg" alt="">
												<h3>Erik L. Richards</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo3.jpg" alt="">
												<h3>John Doe</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/photo4.jpg" alt="">
												<h3>Renee I. Hansen</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
										<li>
											<a href="#">
												<img src="vendors/images/img.jpg" alt="">
												<h3>Vicki M. Coleman</h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="user-info-dropdown">
						<div class="dropdown">
							<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
								<span class="user-icon">
									<img src="vendors/images/photo1.jpg" alt="">
								</span>
								<span class="user-name">Ross C. Lopez</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
								<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
								<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
								<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
								<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
							</div>
						</div>
					</div>
					<div class="github-link">
						<a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg" alt=""></a>
					</div>
				</div>
				</div> -->

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
								<!-- Simple Datatable start -->
						<div class="card-box mb-30">
							<div class="pd-20">
								<h4 class="text-blue h4">Data Table Simple</h4>
								<p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p>
							</div>
							<div class="pb-20">
								<table class="data-table table stripe hover nowrap">
									<thead>
										<tr>
											<th class="table-plus datatable-nosort">Name</th>
											<th>Age</th>
											<th>Office</th>
											<th>Address</th>
											<th>Start Date</th>
											<th class="datatable-nosort">Action</th>
										</tr>
									</thead>
									<tbody>

										<?php

										foreach ($users as $user) {
											if ($user['role'] == 'Student') : ?>



												<tr>
													<td class="table-plus"><?php echo htmlspecialchars($user['full_name']); ?></td>
													<td><?php echo htmlspecialchars($user['email']); ?></td>
													<td><?php echo htmlspecialchars($user['address']); ?></td>
													<td><?php echo htmlspecialchars($user['phone_number']); ?></td>
													<td><?php echo htmlspecialchars($user['address']); ?></td>
													<td>
														<div class="dropdown">
															<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
																<i class="dw dw-more"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
																<a class="dropdown-item" href="studentProfileEdit.php?id=<?php echo $user['user_id']; ?>"><i class="dw dw-eye"></i>View</a>
																<!-- <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i>Edit</a> -->
																<a class="dropdown-item" href="student-remove.php?id=<?php echo $user['student_id']; ?>"><i class="dw dw-delete-3"></i>Delete</a>
															</div>
														</div>
													</td>
												</tr>

										<?php
											endif;
										}
										?>
										
									</tbody>
								</table>
							</div>
						</div>
						<!-- Simple Datatable End -->
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