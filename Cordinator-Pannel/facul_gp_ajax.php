<?php
// Start session
session_start();

// Database connection
require "../Connection/connection.php";
include "./Components/header.php";

// Initialize variables
$can_submit = false;

// Check if the user is logged in
$profile = "SELECT u.user_id as facultyid, u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";
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
                                <h1>Calculate Faculty GPA</h1>

                                <!-- Form for selecting faculty and batch -->
                                <form method="POST" action="">
                                    <label for="faculty_id">Select Faculty:</label>
                                    <select name="faculty_id" id="faculty_id" required onchange="this.form.submit()" class="form-control">
                                        <option value="">Select Faculty</option>
                                        <?php
                                        // Populate faculty options
                                        $faculty_query = "SELECT `users`.*, users.user_id as fac_id, `employees`.*
FROM `users` 
INNER JOIN employees ON employees.email = users.email 
WHERE employees.designation = 'Faculty' AND users.user_id =".$data['facultyid'].";";
                                        $faculty_result = mysqli_query($connection, $faculty_query);

                                        while ($row = mysqli_fetch_assoc($faculty_result)) {
                                            $selected = isset($_POST['faculty_id']) && $_POST['faculty_id'] == $row['fac_id'] ? 'selected' : '';
                                            echo "<option value='{$row['fac_id']}' $selected>{$row['full_name']}</option>";
                                        }
                                        ?>
                                    </select><br>
                                </form>

                                <form method="POST" action="">
                                    <label for="batch_id">Select Batch:</label>
                                    <select name="batch_id" id="batch_id" required class="form-control">
                                        <option value="">Select Batch</option>
                                        <?php
                                        if (isset($_POST['faculty_id'])) {
                                            $selected_faculty_id = mysqli_real_escape_string($connection, $_POST['faculty_id']);

                                            // Populate batch options based on selected faculty
                                            $batch_query = "SELECT DISTINCT batch_id, batch_name, assigned_faculty 
                                                        FROM batches
                                                        WHERE assigned_faculty = '$selected_faculty_id'";
                                            $batch_result = mysqli_query($connection, $batch_query);

                                            while ($row = mysqli_fetch_assoc($batch_result)) {
                                                echo "<option value='{$row['batch_id']}'>{$row['batch_name']}</option>";
                                            }
                                        }
                                        ?>
                                    </select><br>

                                    <input type="hidden" name="faculty_id" value="<?php echo isset($_POST['faculty_id']) ? $_POST['faculty_id'] : ''; ?>">
                                    <button type="submit" name="calculate_gpa" class="btn btn-danger">Calculate GPA</button>
                                </form><br>

                                <?php
                                // Handle form submission
                                if (isset($_POST['calculate_gpa'])) {
                                    $selected_faculty_id = mysqli_real_escape_string($connection, $_POST['faculty_id']);
                                    $selected_batch_id = mysqli_real_escape_string($connection, $_POST['batch_id']);

                                    // Calculate GPA
                                    $gpa_query = "SELECT ROUND(AVG(total_gpa), 2) AS Faculty_Batch_GPA, batch_ID 
FROM faculty_gpa 
WHERE faculty_id = '$selected_faculty_id' 
  AND batch_ID = '$selected_batch_id';";
                                    $gpa_result = mysqli_query($connection, $gpa_query);

                                    if (mysqli_num_rows($gpa_result) > 0) {
                                        $gpa_data = mysqli_fetch_assoc($gpa_result);
                                        echo "<h2>GPA Of Faculty for batch $selected_batch_id: {$gpa_data['Faculty_Batch_GPA']}</h2>";
                                    } else {
                                        echo "<h2>No GPA data found for the selected faculty and batch.</h2>";
                                    }
                                }
                                ?>

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

?>