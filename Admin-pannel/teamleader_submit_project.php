<?php

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
                        <div class="min-height-200px">
                            <div class="page-header">
                                <h1>Submit Your Project</h1>
                                <p>Submit your project by filling out the form below.</p>
                            </div>

                            <?php
                            // Project submission logic
                            if (isset($_POST['submit_project'])) {
                                $project_id = $_POST['project_id'];
                                $group_id = $_GET['id']; // Use $_GET if the group_id is passed via GET

                                // Handle file upload
                                $submission_file = '';
                                if (!empty($_FILES['submission_file']['name'])) {
                                    $submission_file = basename($_FILES['submission_file']['name']);
                                    $target_dir = "submissions/";

                                    // Ensure directory exists
                                    if (!is_dir($target_dir)) {
                                        mkdir($target_dir, 0777, true);
                                    }

                                    $target_file = $target_dir . $submission_file;

                                    // Move uploaded file to the target directory
                                    move_uploaded_file($_FILES['submission_file']['tmp_name'], $target_file);
                                }

                                $submission_date = date('Y-m-d');

                                // Insert submission data into the submissions table
                                $insertSubmission = "INSERT INTO e_submissions (project_id, group_id, submission_file, submission_date) 
                                                     VALUES ('$project_id', '$group_id', '$submission_file', '$submission_date')";
                                if (mysqli_query($connection, $insertSubmission)) {
                                    echo "<p>Project submitted successfully!</p>";
                                } else {
                                    echo "<p>Error: " . mysqli_error($connection) . "</p>";
                                }
                            }
                            ?>

                            <form method="POST" action="" enctype="multipart/form-data">
                                <label for="project_id">Select Project:</label>
                                <select name="project_id" id="project_id" class="form-control" required>
                                    <?php
                                    // Assuming $group_id is the ID of the group you want to fetch projects for
                                    $group_id = $_GET['id']; // Use $_GET if the group_id is passed via GET

                                    // Query to fetch projects assigned to the group
                                    $queryProjects = "
                                        SELECT p.project_id, p.title AS project_title
                                        FROM projects p
                                        WHERE p.group_id = '$group_id'
                                    ";

                                    // Execute the query
                                    $resultProjects = mysqli_query($connection, $queryProjects);

                                    if ($resultProjects) {
                                        // Output options for the select element
                                        while ($project = mysqli_fetch_assoc($resultProjects)) {
                                            echo "<option value='{$project['project_id']}'>{$project['project_title']}</option>";
                                        }
                                    } else {
                                        // Handle query error
                                        echo "<option value=''>Error fetching projects: " . mysqli_error($connection) . "</option>";
                                    }
                                    ?>
                                </select><br>

                                <label for="submission_file">Submission File:</label>
                                <input type="file" name="submission_file" id="submission_file" class="form-control" required><br>

                                <button type="submit" name="submit_project" class="btn btn-danger">Submit Project</button>
                            </form>

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
