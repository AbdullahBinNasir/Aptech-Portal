<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // Fetch student details
    $profile = "SELECT u.*, s.*,u.user_id as stdid FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {

            $student_id = $data['stdid'];

            // Fetch the groups that the student is a part of
             // Replace with the actual student ID from your session
            $queryGroups = "
                SELECT g.group_id, g.group_name 
                FROM groups g
                INNER JOIN group_members gm ON g.group_id = gm.group_id
                WHERE gm.student_id = '$student_id'
            ";

            $resultGroups = mysqli_query($connection, $queryGroups);

            if (!$resultGroups) {
                echo "Error fetching groups: " . mysqli_error($connection);
                exit;
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
                                <h2 class="text-center">Select a Group</h2>
                                <p class="text-center">Please select a group to view the assigned projects.</p>


                                <form method="POST" action="student_view_projects.php" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Choose a Group:</label>
                                        <select name="group_id" id="group_id" class="form-control" required>
                                            <option value="">Select a group</option>
                                            <?php while ($group = mysqli_fetch_assoc($resultGroups)): ?>
                                                <option value="<?php echo htmlspecialchars($group['group_id']); ?>">
                                                    <?php echo htmlspecialchars($group['group_name']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select><br>
                                        <div class="invalid-feedback">
                                            Please select a group.
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger">View Assigned Projects</button>
                                </form>
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