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
								$read =   "SELECT * FROM `departments`;";
								$result = mysqli_query($connection, $read);

								if ($result) {
									if (mysqli_num_rows($result) > 0) {
								?>
										<table class="data-table table stripe hover nowrap">
											<thead>
												<tr>
													<th class="table-plus datatable-nosort">ID</th>
													<th>Department Name</th>
													<th>Head Of Department</th>
													<th>Locaion</th>
													<th>Contact details</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												while ($row = mysqli_fetch_assoc($result)) {






													echo "	<tr>
											<td class='table-plus'>" . $row['department_id'] . "</td>
													<td>" . $row['department_name'] . "</td>
													<td>" . $row['head_of_department'] . "</td>
													<td>" . $row['location'] . "</td>
                                                    <td>" . $row['contact_details'] . "</td>
													<td>";
													echo "
												
												 <a href='department_edit.php?id=" . $row['department_id'] . "' class='btn btn-warning px-4  rounded-pill m-1' >Edit</a>
												 
                                                <a href='department_delete.php?id=" . $row['department_id'] . "' class='btn btn-danger px-4 rounded-pill m-1'>Delete</a></td>
													</td>";

													echo "</tr>";
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





					</div>

					<!-- Footer Starts Here -->
					<?php
					include "./Components/footer.php";
					?>
					<!-- Footer Ends Here -->
				</div>
				</div>
				<!-- js -->
				<script>
					function abc() {
						Swal.fire({
							title: 'Error!',
							text: 'Do you want to continue',
							icon: 'error',
							confirmButtonText: 'Cool'
						})
					}
				</script>
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