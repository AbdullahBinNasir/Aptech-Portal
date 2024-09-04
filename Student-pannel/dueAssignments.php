<?php
// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['email'])) {

    // Get the user's profile details
    $profile = "SELECT u.*,u.user_id as studentid, s.*, b.*, emp.* FROM users u INNER JOIN students s ON u.email = s.email INNER JOIN batches b ON s.batch_id = b.batch_id LEFT JOIN employees emp ON u.email = emp.email WHERE u.email = '" . $_SESSION['email'] . "';";
    $get_Pic = mysqli_query($connection, $profile);

    
    if (mysqli_num_rows($get_Pic) > 0) {
        $data = mysqli_fetch_assoc($get_Pic);
        $studentid = $data['studentid'];

        
        if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Fetch student information
            $studentQuery = "SELECT * FROM students WHERE email = '$email'";
            $studentResult = mysqli_query($connection, $studentQuery);

            if (mysqli_num_rows($studentResult) > 0) {
                $student = mysqli_fetch_assoc($studentResult);
                $student_id = $student['student_id'];
                $batch_id = $student['batch_id'];

                // Fetch due assignments for the student's batch
                $assignmentsQuery = "
            SELECT * FROM assignments
            WHERE batch_id = '$batch_id' AND due_date >= CURDATE()
            ORDER BY due_date ASC
        ";
                $assignmentsResult = mysqli_query($connection, $assignmentsQuery);

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
                                    <h1>Due Assignments</h1>
                                    <p>Start Your Work From Here</p>


                                    <?php
                                    if (mysqli_num_rows($assignmentsResult) > 0) {
                                        echo "<div class='container mt-5'>";
                                        echo "<table class='table table-striped table-bordered'>";
                                        echo "<thead class='thead-dark'>";
                                        echo "<tr>";
                                        echo "<th scope='col'>Assignment Title</th>";
                                        echo "<th scope='col'>Due Date</th>";
                                        echo "<th scope='col'>Description</th>";
                                        echo "<th scope='col'>Status</th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";

                                        while ($assignment = mysqli_fetch_assoc($assignmentsResult)) {
                                            // Check if the student has submitted this assignment
                                            $assignment_id = $assignment['assignment_id'];
                                            $submissionQuery = "
                                    SELECT * FROM submissions 
                                    WHERE assignment_id = '$assignment_id' AND student_id = '$studentid'
                                ";
                                            $submissionResult = mysqli_query($connection, $submissionQuery);

                                            $status = (mysqli_num_rows($submissionResult) > 0) ? 'Submitted' : 'Not Submitted';

                                            echo "<tr>";
                                            echo "<td>" . $assignment['title'] . "</td>";
                                            echo "<td>" . $assignment['due_date'] . "</td>";
                                            echo "<td>" . $assignment['description'] . "</td>";
                                            echo "<td>" . $status . "</td>";
                                            echo "</tr>";
                                        }

                                        echo "</tbody>";
                                        echo "</table>";
                                        echo "</div>";
                                    } else {
                                        echo "<div class='container mt-5'>";
                                        echo "<p class='alert alert-info'>No due assignments found.</p>";
                                        echo "</div>";
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
                    </div>
                    <!-- js -->
                    <script src="vendors/scripts/core.js"></script>
                    <script src="vendors/scripts/script.min.js"></script>
                    <script src="vendors/scripts/process.js"></script>
                    <script src="vendors/scripts/layout-settings.js"></script>
                </body>

                </html>

<?php
            } else {
                echo "<div class='container mt-5'>";
                echo "<p class='alert alert-danger'>Student not found.</p>";
                echo "</div>";
            }
        } else {
            echo "<div class='container mt-5'>";
            echo "<p class='alert alert-warning'>Please log in to view your assignments.</p>";
            echo "</div>";
        }
    }
}
?>