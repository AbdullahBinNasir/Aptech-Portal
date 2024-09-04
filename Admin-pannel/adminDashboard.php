<?php

require "../Connection/connection.php";
include "./Components/header.php";
session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = '" . $_SESSION['email'] . " ';";

	$get_Pic = mysqli_query($connection, $profile);

	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {
			// session_start();
			// echo $data['username'];
			// echo $data['role'];
			// echo $data['full_name'];
			// echo $data['email'];
			// echo $data['phone_number'];
			// echo $data['Profile'];


			$userCount = 'SELECT COUNT(*) AS total_users FROM users;';
			$totalUser = mysqli_query($connection, $userCount);

			if (mysqli_num_rows($totalUser) > 0) {
				$totalUsers = mysqli_fetch_assoc($totalUser);
			}


			$totalApprovedFaculty = "SELECT COUNT(*) AS total_faculties FROM employees e JOIN users u ON e.email = u.email WHERE e.designation = 'faculty' AND u.is_approved = 1;";
			$totalApproveFac = mysqli_query($connection, $totalApprovedFaculty);

			if (mysqli_num_rows($totalApproveFac) > 0) {
				$totalFac = mysqli_fetch_assoc($totalApproveFac);
			}

			$totalApprovedEmployee = "SELECT COUNT(*) AS total_Emp FROM employees e JOIN users u ON e.email = u.email WHERE u.is_approved = 1;";
			$totalApproveEmp = mysqli_query($connection, $totalApprovedEmployee);

			if (mysqli_num_rows($totalApproveEmp) > 0) {
				$totalEmp = mysqli_fetch_assoc($totalApproveEmp);
			}


			$totalApprovedStd = "SELECT COUNT(*) AS total_students FROM students s JOIN users u ON s.email = u.email WHERE u.is_approved = 1;";
			$totalApproveStd = mysqli_query($connection, $totalApprovedStd);

			if (mysqli_num_rows($totalApproveStd) > 0) {
				$totalStd = mysqli_fetch_assoc($totalApproveStd);
			}



			$sql = "SELECT s.*, u.* FROM students s INNER JOIN users u ON s.email = u.email ;";
			$result = $connection->query($sql);


			$users = [];

			if ($result->num_rows > 0) {

				while ($rows = $result->fetch_assoc()) {
					$users[] = $rows;
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

 <!-- <script>
					Swal.fire({
						title: 'Error!',
						text: 'Do you want to continue',
						icon: 'error',
						confirmButtonText: 'Cool'
					})
				</script>" -->



				<div class="main-container">
					<div class="pd-ltr-20">
						<div class="card-box pd-20 height-90-p mb-30">
							<div class="row align-items-center">
								<div class="col-md-4">
									<img src="vendors/images/banner-img.png" alt="">
								</div>
								<div class="col-md-8">
									<h4 class="font-20 weight-500 mb-10 text-capitalize">
										Welcome back <div class="weight-600 font-30 text-danger" ><?php echo $data['username']; ?></div>
									</h4>
									<p class="font-18 max-width-600">We hope you're having a fantastic day. Your commitment and enthusiasm are truly appreciated. Keep striving for excellence and making a positive impact.<br /><br />

										Have a great day ahead!</p>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-3 mb-30">
								<div class="card-box height-100-p widget-style1">
									<div class="d-flex flex-wrap align-items-center">
										<div class="progress-data">
											<div id="chart"></div>
										</div>
										<div class="widget-data">
											<div class="h4 mb-0"><?php echo $totalUsers['total_users'] ?></div>
											<div class="weight-600 font-14">Total Users</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 mb-30">
								<div class="card-box height-100-p widget-style1">
									<div class="d-flex flex-wrap align-items-center">
										<div class="progress-data">
											<div id="chart2"></div>
										</div>
										<div class="widget-data">
											<div class="h4 mb-0"><?php echo $totalFac['total_faculties'] ?></div>
											<div class="weight-600 font-14">Total Faculties</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 mb-30">
								<div class="card-box height-100-p widget-style1">
									<div class="d-flex flex-wrap align-items-center">
										<div class="progress-data">
											<div id="chart3"></div>
										</div>
										<div class="widget-data">
											<div class="h4 mb-0"><?php echo $totalStd['total_students'] ?></div>
											<div class="weight-600 font-14">Students</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 mb-30">
								<div class="card-box height-100-p widget-style1">
									<div class="d-flex flex-wrap align-items-center">
										<div class="progress-data">
											<div id="chart4"></div>
										</div>
										<div class="widget-data">
											<div class="h4 mb-0"><?php echo $totalEmp['total_Emp'] ?></div>
											<div class="weight-600 font-14">Total Employees</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-xl-8 mb-30">
								<div class="card-box height-100-p pd-20">
									<h2 class="h4 mb-20">Activity</h2>
									<div id="chart5"></div>
								</div>
							</div>
							<div class="col-xl-4 mb-30">
								<div class="card-box height-100-p pd-20">
									<h2 class="h4 mb-20">Lead Target</h2>
									<div id="chart6"></div>
								</div>
							</div>
						</div> -->
						<!-- <div class="card-box mb-30">
							<h2 class="h4 pd-20">Best Selling Products</h2>
							<table class="data-table table nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Product</th>
										<th>Name</th>
										<th>Color</th>
										<th>Size</th>
										<th>Price</th>
										<th>Oty</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="table-plus">
											<img src="vendors/images/product-1.jpg" width="70" height="70" alt="">
										</td>
										<td>
											<h5 class="font-16">Shirt</h5>
											by John Doe
										</td>
										<td>Black</td>
										<td>M</td>
										<td>$1000</td>
										<td>1</td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
													<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
													<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">
											<img src="vendors/images/product-2.jpg" width="70" height="70" alt="">
										</td>
										<td>
											<h5 class="font-16">Boots</h5>
											by Lea R. Frith
										</td>
										<td>brown</td>
										<td>9UK</td>
										<td>$900</td>
										<td>1</td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
													<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
													<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">
											<img src="vendors/images/product-3.jpg" width="70" height="70" alt="">
										</td>
										<td>
											<h5 class="font-16">Hat</h5>
											by Erik L. Richards
										</td>
										<td>Orange</td>
										<td>M</td>
										<td>$100</td>
										<td>4</td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
													<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
													<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">
											<img src="vendors/images/product-4.jpg" width="70" height="70" alt="">
										</td>
										<td>
											<h5 class="font-16">Long Dress</h5>
											by Renee I. Hansen
										</td>
										<td>Gray</td>
										<td>L</td>
										<td>$1000</td>
										<td>1</td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
													<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
													<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">
											<img src="vendors/images/product-5.jpg" width="70" height="70" alt="">
										</td>
										<td>
											<h5 class="font-16">Blazer</h5>
											by Vicki M. Coleman
										</td>
										<td>Blue</td>
										<td>M</td>
										<td>$1000</td>
										<td>1</td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
													<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
													<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div> -->


						<!-- Simple Datatable start -->
						<div class="card-box mb-30">
							<div class="pd-20">
								<h4 class="text-blue h4 text-danger" >Student Pending Approval</h4>
								<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
							</div>
							<div class="pb-1">
								<table class="data-table table stripe hover nowrap">
									<thead>
										<tr>
											<th class="table-plus datatable-nosort">Name</th>
											<th>Email</th>
											<th>Address</th>
											<th>CNIC</th>
											<!-- <th>Start Date</th> -->
											<th class="datatable-nosort">Action</th>
										</tr>
									</thead>
									<tbody>

										<?php

										foreach ($users as $user) {
											if ($user['role'] == 'Student' && $user['is_approved'] == 0) : ?>



												<tr>
													<td class="table-plus"><?php echo htmlspecialchars($user['full_name']); ?></td>
													<td><?php echo htmlspecialchars($user['email']); ?></td>
													<td><?php echo htmlspecialchars($user['address']); ?></td>
													<td><?php echo htmlspecialchars($user['phone_number']); ?></td>
													<!-- <td><?php //echo htmlspecialchars($user['address']); 
																?></td> -->
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
						<!-- Simple Datatable End --><!-- multiple select row Datatable start -->

						<!-- Footer Starts Here -->
						<?php
						include "./Components/footer.php";
						?>
						<!-- Footer Ends Here -->



						<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
						<script>
							window.dataLayer = window.dataLayer || [];

							function gtag() {
								dataLayer.push(arguments);
							}
							gtag('js', new Date());

							gtag('config', 'UA-119386393-1');
						</script>
						<!-- js -->
						<script src="vendors/scripts/core.js"></script>
						<script src="vendors/scripts/script.min.js"></script>
						<script src="vendors/scripts/process.js"></script>
						<script src="vendors/scripts/layout-settings.js"></script>
						<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
						<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
						<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
						<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
						<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
						<script src="vendors/scripts/dashboard.js"></script>

			</body>

			</html>

<?php
		}
	}
}
?>