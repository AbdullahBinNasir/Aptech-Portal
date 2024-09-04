<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, u.user_id as std_id, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";

	$get_Pic = mysqli_query($connection, $profile);


	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {




            if(isset($_POST['regdata'])){
                $event = $_POST['event'];
                $std = $_POST['std'];
                $reg = $_POST['reg'];
                // $status=$_POST['status'];
                // $payment=$_POST['payment'];
                
                $insert = "INSERT INTO `registrations`(`event_id`,`student_id`,`registration_date`) 
                values ('$event', '$std', '$reg');";
                $result = mysqli_query($connection, $insert);

                if($result){
                
                    echo "<script>alert('Student details added succesfully...')</script>";
                
                }
                else{
                
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
                            <div class="container">
									<h1 class="text-center">Registrations</h1>

									<form action="" method="post" class="form-group">

                                    <div class="form-group">
											<label for="event">Enter event name  </label>
											<select name="event" id="event" class="form-control">
                                                  <!-- <option value="" selected>ADMIN</option> -->
                                                  <!-- <option value="" >HR</option> -->
                                                   <?php 
                                                   
                                                   $getorganizer = "SELECT * FROM events ;";
                                                   $getorganizer_run=mysqli_query($connection, $getorganizer) or die("failed to get categories");
                                                    if(mysqli_num_rows($getorganizer_run) > 0){
                                                        while($organizer=mysqli_fetch_assoc($getorganizer_run)){
                                                            echo'<option value="'.$organizer['event_id'].'" >'.$organizer['event_name'].'</option>';
                                                        }
                                                    }
                                                   ?>
			                                       </select>
										</div>

										<div class="form-group">



										<div class="form-group">
											<label for="std">Enter Student Id  </label>
											<input type="text" name="std" id="std" class='form-control my-2' value="<?php echo $data['std_id']  ?>" Readonly>
										</div>
										<div class="form-group">
											<label for="nam">Enter Student name  </label>
											<input type="text" name="nam" id="nam" class='form-control my-2' value="<?php echo $data['full_name']  ?>" Readonly>
										</div>

										<div class="form-group">
											<label for="reg">Enter registration Date </label>
											<input type="date" name="reg" class="form-control my-2" placeholder="Enter registration date ">
										</div>
                                       

										<input type="submit" value="Submit Form" name="regdata" class="form-control btn btn-danger my-2 text-light">

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