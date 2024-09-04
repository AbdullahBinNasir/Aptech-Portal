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
                $getdata="SELECT * FROM `departments` WHERE department_id ='$id';";
            
                $result=mysqli_query($connection, $getdata) or die("fail to run query");
            
                if(mysqli_num_rows($result) == 1){
            $row=mysqli_fetch_assoc($result);
            
            //  $id=$row['id'];
             $name=$row['department_name'];
             $head=$row['head_of_department'];
             $location=$row['location'];
             $contact=$row['contact_details'];
           
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
                                   <form action="department_updatedata.php" method="post" class="form-group">
                                   <input type="hidden" name="id" id="" class="form-control my-2 red-input" value="<?php echo $id ?>">
                                   <input type="text" name="name" id="" class="form-control my-2 red-input" placeholder="Enter department name" value="<?php echo $name ?>">
                                   <input type="hidden" name="head" id="" class="form-control my-2 red-input" placeholder="" value="<?php echo $head ?>">
                                   <input type="text" name="location" id="" class="form-control my-2 red-input" placeholder="Enter department location" value="<?php echo $location ?>">
                                   <input type="number" name="contact" id="" class="form-control my-2 red-input" placeholder="Enter contact_details " value="<?php echo $contact ?>">
                                   <input type="submit" name="Add" id="" class="form-control btn btn-danger my-2 text-light">
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