<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";

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
						<!-- Simple Datatable start -->
						<div class="card-box mb-30">
							<div class="pd-20">
								<h4 class="text-danger h4">Event Details</h4>
								<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
							</div>


							<div class="min-height-200px">



								<div class="page-header">
									<div class="pb-20">
										<?php
										//   $read =   "SELECT * FROM `events`;";
										$read =   "SELECT u.*, ev.* FROM users u INNER JOIN events ev ON u.user_id = ev.organizer_id  WHERE u.user_id;";


										$result = mysqli_query($connection, $read);

										if ($result) {
											if (mysqli_num_rows($result) > 0) {
										?>
												<table class="data-table table stripe hover nowrap">
													<thead>
														<tr>
															<th class="table-plus datatable-nosort">ID</th>
															<th>Event Name</th>
															<th>Description</th>
															<th>Date</th>
															<th>Locaion</th>
															<th>Organizer</th>
															<th>Deadline</th>
															<th>Max Attendees</th>
														
														</tr>
													</thead>
													<tbody>
														<?php
														while ($row = mysqli_fetch_assoc($result)) {






															echo "	<tr>
													<td class='table-plus'>" . $row['event_id'] . "</td>
													<td>" . $row['event_name'] . "</td>
													<td>" . $row['description'] . "</td>
													<td>" . $row['event_date'] . "</td>
													<td>" . $row['location'] . "</td>
													<td>" . $row['full_name'] . "</td>
													<td>" . $row['registration_deadline'] . "</td>
                                                    <td>" . $row['max_attendees'] . "</td>
													

														 </tr>";
														}
														?>

													</tbody>
												</table>
										<?php
											} else {
												echo "<script>alert('record not found')</script>";
											}
										} else {
											echo "<script>alert('Failed to execute query')</script>";
										}




										?>
									</div>
								</div>
								<!-- Simple Datatable End --><!-- multiple select row Datatable start -->


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

?>