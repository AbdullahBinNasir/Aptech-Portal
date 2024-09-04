<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, h.* FROM users u INNER JOIN hr h ON u.email = h.email WHERE u.email = '" . $_SESSION['email'] . " ';";

	$get_Pic = mysqli_query($connection, $profile);


	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {







			//yeh event ka kaam hai
			if (isset($_POST['signup123'])) {

				$name = $_POST['name'];
				$description = $_POST['description'];
				$eventDate = $_POST['event-date'];
				$location = $_POST['location'];
				$Organizer_id = $_POST['organizer_id'];
				$deadline = $_POST['deadline'];
				$attendance = $_POST['attendence'];

				// echo $_POST['signup123'];


				$insert = "INSERT INTO `events`(`event_name`, `description`, `event_date`,`location`,`organizer_id`,`registration_deadline`,`max_attendees`) 
				values ('$name', '$description', '$eventDate','$location', '$Organizer_id','$deadline','$attendance');";

				$result = mysqli_query($connection, $insert) or die("Failed to insert query");

				if ($result) {

					echo "<script>alert('Student details added succesfully...')</script>";
				} else {

					echo "<script>alert('Failed to insert data.. ')</script>";
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

								<div class="container my-4">
									<h1 class="text-center">Events</h1>
									<form action="" method="post" class="form-group">
										<div class="form-group">
											<label class=" mt-3" for="name">Enter Event Name:</label>
											<input type="text" name="name" id="name" class="form-control " placeholder="Enter Event Name">
										</div>
										<div class="form-group">
											<label class=" mt-3" for="description">Enter Event Descprition</label>
											<input type="text" name="description" id="description" class="form-control " placeholder="Enter Event description">
										</div>
										<div class="form-group">
											<label class=" mt-3" for="date">Enter Event date:</label>
												">
										</div>
										<div class="form-group">
											<label class=" mt-3" for="location">Location:</label>
											<input type="text" name="location" id="location" class="form-control " placeholder="Enter Event Location">
										</div>

										<label class=" mt-3" for="Organizer">Organizer:</label>

										<select name="organizer_id" id="Organizer" class="form-control">
											<!-- <option value="" selected>ADMIN</option> -->
											<!-- <option value="" >HR</option> -->
											<?php

											$getorganizer = "SELECT * FROM users WHERE role='Admin' OR role='HR';";
											$getorganizer_run = mysqli_query($connection, $getorganizer) or die("failed to get categories");
											if (mysqli_num_rows($getorganizer_run) > 0) {
												while ($organizer = mysqli_fetch_assoc($getorganizer_run)) {
													echo '<option value="' . $organizer['user_id'] . '" >' . $organizer['full_name'] . '</option>';
												}
											}
											?>
										</select>

										<div class="form-group">
											<label class=" mt-4" for="deadline">Registration Deadline:</label>
											<input type="date" name="deadline" id="deadline" class="form-control " placeholder="Registration Deadline">
										</div>
										<div class="form-group">
											<label class=" mt-3" for="attendence">Maximum Attendence:</label>
											<input type="number" name="attendence" id="atteandence" class="form-control " placeholder="Max Attendies">
										</div>
										<!-- <input type="text" name="address" id="" class="form-control my-2" placeholder="Enter Your Address">
            <input type="number" nanume="phone" id="" placeholder="Enter Your Phone Number" class="form-control"> <br> <br>
            <input type="number" name="f-phone" id="" placeholder="Enter Your Guardian Phone Number" class="form-control"> <br> <br>
            <input type="number" name="CNIC" placeholder="CNIC/B-FORM" id="" class="form-control">
            <input class="form-control my-3" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
            <select name="program" id="">
                <option value="ADSE">ADSE</option>
                <option value="DISM">DISM</option>
                <option value="CPISM">CPISM</option>
            </select>
            <select name="courses" id="">
                <option value="FrontEnd-Dev">FrontEnd-Development</option>
                <option value="BackEnd-Dev">BackEnd-Development</option>
            </select> -->
										<input type="submit" name="signup123" id="" class="form-control btn btn-danger my-2 text-light" >
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

?>