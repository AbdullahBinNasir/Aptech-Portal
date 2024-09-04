<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // Fetch user profile and student details
    $profile = "SELECT u.*, u.user_id as std_id, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";
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
                                <h1>Submit Your Assignment</h1>
                                <p>Upload your assignment file here.</p><br>


                                <!-- Assignment Submission Form -->
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="assignment_id">Select Assignment:</label>
                                        <select name="assignment_id" id="assignment_id" class="form-control my-3 red-input" required>
                                            <option value="" disabled selected>Select Assignment</option>
                                            <?php
                                            $getassignment = "SELECT * from `assignments` where batch_id = ".$data['batch_id'].";";
                                            $getassignment_run = mysqli_query($connection, $getassignment) or die("Failed to get assignments");
                                            if (mysqli_num_rows($getassignment_run) > 0) {
                                                while ($assignment = mysqli_fetch_assoc($getassignment_run)) {
                                                    echo '<option value="' . $assignment['assignment_id'] . '">' . $assignment['title'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="student_id">Student ID:</label>
                                       
										
											<input type="text" name="student_id" id="std" class='form-control my-2' value="<?php echo $data['std_id']  ?>" Readonly>
											
									
                                    </div>

                                    <div class="form-group">
                                        <label for="batch_id">Batch ID:</label>
                                        <input type="number" name="batch_id" id="batch_id" class="form-control my-3 red-input" value="<?php echo $data['batch_id']  ?>" required Readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="assignment_file">Upload Assignment:</label>
                                        <input type="file" name="assignment_file" id="assignment_file" class="form-control my-3 red-input" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Submit Assignment" class="btn btn-danger">
                                    </div>
                                </form>

                                <?php
                                // Handle assignment submission
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $assignment_id = $_POST['assignment_id'];
                                    $student_id = $_POST['student_id'];
                                    $submission_date = date("Y-m-d");
                                    $batch_id = $_POST['batch_id'];
                                    $file_path = "../Employee_pannel/assignments/" . basename($_FILES["assignment_file"]["name"]);

                                    // Upload file and insert submission data
                                    if (move_uploaded_file($_FILES["assignment_file"]["tmp_name"], $file_path)) {
                                        $sql = "INSERT INTO submissions (assignment_id, student_id, submission_date, file_path, Assigned_batch)
											VALUES ('$assignment_id', '$student_id', '$submission_date', '$file_path', '$batch_id')";

                                        if ($connection->query($sql) === TRUE) {
                                            echo "<div class='alert alert-success'>Assignment submitted successfully.</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $connection->error . "</div>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
                                    }

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
} else {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>