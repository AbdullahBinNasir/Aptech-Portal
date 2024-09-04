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
// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

// session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Get Group_Id from URL
    if (isset($_GET['group_id'])) {
        $group_id = $_GET['group_id'];

        // Prepare query to fetch details based on Group_Id
        $query = "
            SELECT 
                epa.Group_Id,
                b.batch_name,
                u.full_name
            FROM 
                e_project_assignments epa
            LEFT JOIN 
                batches b ON epa.batch_id = b.batch_id
            LEFT JOIN 
                users u ON epa.student_id = u.user_id
            WHERE 
                epa.Group_Id = ?
        ";

        $stmt = $connection->prepare($query);
        $stmt->bind_param('i', $group_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the project details for the specified Group_Id
        $projectDetails = null;
        if ($result->num_rows > 0) {
            $projectDetails = $result->fetch_assoc();
        }
        $stmt->close();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assign Project</title>
        <style>
            .container {
                padding: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
            }

            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .form-group input[type="file"] {
                padding: 3px;
            }

            .btn {
                padding: 10px 15px;
                color: #fff;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                display: inline-block;
                margin-top: 10px;
            }

            .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Assign Project to Group</h1>

            <?php if ($projectDetails): ?>
                <form action="process_assign_project.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="group_id" value="<?= htmlspecialchars($projectDetails['Group_Id']); ?>">

                    <div class="form-group">
                        <label for="project_title">Project Title:</label>
                        <input type="text" id="project_title" name="project_title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="attachments">Attachments:</label>
                        <input type="file" id="attachments" name="attachments">
                    </div>

                    <div class="form-group">
                        <label for="submission_date">Submission Date:</label>
                        <input type="date" id="submission_date" name="submission_date" required min="<?= date('Y-m-d'); ?>">
                    </div>


                    <button type="submit" class="btn btn-danger">Assign Project</button>
                </form>
            <?php else: ?>
                <p>No project details found for the specified group.</p>
            <?php endif; ?>
        </div>
    </body>

    </html>
    <?php
    // Close the connection
    $connection->close();
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

