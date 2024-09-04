<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // Query to get user and student details
    $profile = "SELECT u.*, s.*,u.user_id as stdid FROM users u 
                INNER JOIN students s ON u.email = s.email 
                WHERE u.email = '" . $_SESSION['email'] . "';";

    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {
            $student_id = $data['stdid']; // Assuming student_id is in the students table
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
                                <h1>Your Marks</h1>
                            </div>

                            <div class="card-box">
                                <div class="pd-20">
                                    <h2 class="text-blue h4">Marks Details</h2>
                                </div>
                                <div class="pb-20">
                                    <table class="data-table table stripe hover nowrap">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Marks Obtained</th>
                                                <th>FeedBack</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Query to get the student's marks
                                            $marks_query = "SELECT `submissions`.*, `assignments`.*
FROM `submissions` 
	LEFT JOIN `assignments` ON `submissions`.`assignment_id` = `assignments`.`assignment_id`
    WHERE submissions.student_id= '$student_id';";
                                            $marks_result = mysqli_query($connection, $marks_query);

                                            if (mysqli_num_rows($marks_result) > 0) {
                                                while ($row = mysqli_fetch_assoc($marks_result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['title'] . "</td>";
                                                    echo "<td>" . $row['marks'] . "</td>";
                                                    echo "<td>" . $row['feedback'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>No marks found for this student.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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