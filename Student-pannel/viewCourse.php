
<?php




require ('../Connection/connection.php');

$sql = "SELECT * FROM courses ;";
$result = $connection->query($sql);


$users = [];

if ($result->num_rows > 0) {

    while ($rows = $result->fetch_assoc()) {
        $users[] = $rows;
    }
}

?>

<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	$profile = "SELECT u.*, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";

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
								<h4 class="text-blue h4">Event Details</h4>
								<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
							</div>


						<div class="min-height-200px">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Table</title>
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Link to your CSS -->


    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <!-- <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title> -->

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>

</head>

<>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Courses</h4>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Image</th>
                        <th>Course-Title</th>
                        <th>Course Description</th>
                        <!-- <th>Phone Number</th> -->
                        <!-- <th>Start Date</th> -->
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($users as $user) {
                        // if ($user['role'] == 'Student'): ?>
                        <tr>
                            <td class="table-plus"><img src="<?php echo htmlspecialchars($user['image']); ?>"
                                    alt="Course Image" style="width: 100px; height: auto;"></td>
                            <td class="table-plus"><?php echo htmlspecialchars($user['Course_Title']); ?></td>
                            <td class="table-plus"><?php echo htmlspecialchars($user['Description']); ?></td>
                            <td>
                                <a href="UpdateCourse.php?id=<?php echo $user['student_id']; ?>"
                                    class="btn btn-success btn-rounded">Edit</a>
                                <a href="student-remove.php?id=<?php echo $user['student_id']; ?>"
                                    class="btn btn-danger btn-rounded">Remove</a>
                            </td>
                        </tr>
                        <?php
                        // endif; 
                    }
                    ?>


                </tbody>
            </table>
            
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