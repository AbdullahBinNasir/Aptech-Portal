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





            if($_GET['id']){
                // echo "id found";
               $id=$_GET['id'];
                $getdata="SELECT * FROM `events` WHERE event_id ='$id';";
            
                $result=mysqli_query($connection, $getdata) or die("fail to run query");
            
                if(mysqli_num_rows($result) == 1){
            $row=mysqli_fetch_assoc($result);
            
            //  $id=$row['id'];
             $name=$row['event_name'];
             $description=$row['description'];
             $location=$row['location'];
             $organizer=$row['organizer_id'];
             $date=$row['event_date'];
             $deadline=$row['registration_deadline'];
             $attendence =$row['max_attendees'];
           
             ?>
            

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
                                       <h1 class="text-center">Enter Event Details</h1>
                                   <form action="abc_updatedata.php" method="post" class="form-group">
                                   <input type="hidden" name="id" id="" class="form-control my-2" value="<?php echo $id ?>">
                                   <input type="text" name="name" id="" class="form-control my-2 red-input" placeholder="Enter Event name" value="<?php echo $name ?>">
                                   <input type="text" name="description" id="" class="form-control my-2 red-input" placeholder="Enter description" value="<?php echo $description ?>">
                                   <input type="date" name="date" id="" class="form-control my-2 red-input" placeholder="Enter event date" value="<?php echo $date ?>">
                                   <input type="text" name="location" id="" class="form-control my-2 red-input" placeholder="Enter event location" value="<?php echo $location ?>">
                                   <input type="hidden" name="organizer" id="" class="form-control my-2 red-input" placeholder="" value="<?php echo $organizer ?>">
                                   <input type="date" name="deadline" id="" class="form-control my-2 red-input" placeholder="Enter event deadline" value="<?php echo $deadline ?>">
                                   <input type="text" name="attendence" id="" class="form-control my-2 red-input" placeholder="Enter attendence" value="<?php echo $attendence ?>">
                                   <input type="submit" name="Add" id="" class="form-control btn btn-danger my-2 text-light" >
                                   </form>
                                   </div>
                                   <?php 
                                       }
                                   }
                                   else{
                                       echo "id not found";
                                   }
                                
                                   ?>
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