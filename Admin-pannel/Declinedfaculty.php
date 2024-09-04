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

			$sql = "SELECT e.*, u.* FROM employees e INNER JOIN users u ON e.email = u.email ;";
			$result = $connection->query($sql);


			$users = [];

			if ($result->num_rows > 0) {

				while ($rows = $result->fetch_assoc()) {
					$users[] = $rows;
				}
			}

?>

			<body>
				<!-- Global site tag (gtag.js) - Google Analytics -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
				<script>
					window.dataLayer = window.dataLayer || [];

					function gtag() {
						dataLayer.push(arguments);
					}
					gtag('js', new Date());

					gtag('config', 'UA-119386393-1');
				</script>

				<div class="pre-loader">


					<!-- Pre-loader  Starts-->
					<?php
					// include "./Components/Preloader.php";
					?>
					<!-- Pre-loader  Ends-->

				</div>

				<!-- top-navbar Starts Here -->
				<?php
				include "./Components/navbar.php";
				?>
				<!-- top-navbar Ends Here -->


				<!-- Right Sidebar starts Here...! -->
				<?php
				include "./Components/rightSidebar.php";
				?>

				<!-- Left Sidebar starts Here...! -->
				<?php
				include "./Components/leftSidebar.php";
				?>
				<!-- Left Sidebar Ends Here...! -->
				<div class="mobile-menu-overlay"></div>

				<div class="main-container">
					<div class="pd-ltr-20 xs-pd-20-10">
						<!-- Simple Datatable start -->
						<div class="card-box mb-30">
							<div class="pd-20">
								<h4 class="text-danger h4">Declined Faculty Data</h4>
								<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
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
											if ($user['role'] == 'Emoployee' && $user['is_approved'] == 3) : ?>



												<tr>
													<td class="table-plus"><?php echo htmlspecialchars($user['full_name']); ?></td>
													<td><?php echo htmlspecialchars($user['email']); ?></td>
													<td><?php echo htmlspecialchars($user['address']); ?></td>
													<td><?php echo htmlspecialchars($user['phone_number']); ?></td>
													<td><?php echo htmlspecialchars($user['address']); ?></td>
													<td>
														<div class="dropdown">
															<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
																<i class="dw dw-more text-danger"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
																<a class="dropdown-item" href="studentProfileEdit.php?id=<?php echo $user['user_id']; ?>"><i class="dw dw-eye"></i>View</a>
																<!-- <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i>Edit</a> -->
																<a class="dropdown-item" href="student-remove.php?id=<?php echo $user['employee_id']; ?>"><i class="dw dw-delete-3"></i>Delete</a>
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


					</div>

					<!-- Footer Starts Here -->
					<?php
					include "./Components/footer.php";
					?>
					<!-- Footer Ends Here -->


				</div>
				</div>
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
				<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
				<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
				<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
				<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
				<!-- buttons for Export datatable -->
				<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
				<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
				<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
				<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
				<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
				<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
				<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
				<!-- Datatable Setting js -->
				<script src="vendors/scripts/datatable-setting.js"></script>
			</body>

			</html>

<?php


		}
	}
}

?>