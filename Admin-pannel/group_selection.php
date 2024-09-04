<?php
require "../Connection/connection.php";
include "./Components/header.php";
session_start();

if (isset($_SESSION['username'])) {
    $student_id = 44; // Replace with the actual student ID from your session

    // Fetch the groups that the student is a part of
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
        <!-- Pre-loader Starts -->
        <?php
        // include "./Components/Preloader.php";
        ?>
        <!-- Pre-loader Ends -->

        <!-- top-navbar Starts Here -->
        <?php
        include "./Components/navbar.php";
        ?>
        <!-- top-navbar Ends Here -->

        <!-- Right Sidebar Starts Here -->
        <?php
        include "./Components/rightSidebar.php";
        ?>
        <!-- Right Sidebar Ends Here -->

        <!-- Left Sidebar Starts Here -->
        <?php
        include "./Components/leftSidebar.php";
        ?>
        <!-- Left Sidebar Ends Here -->

        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <h2 class="text-center">Select a Group</h2>
                    </div>

                    <form method="POST" action="student_view_projects.php" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="group_id" class="form-label">Choose a Group:</label>
                            <select name="group_id" id="group_id" class="form-select" required>
                                <option value="">Select a group</option>
                                <?php while ($group = mysqli_fetch_assoc($resultGroups)): ?>
                                    <option value="<?php echo htmlspecialchars($group['group_id']); ?>">
                                        <?php echo htmlspecialchars($group['group_name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a group.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">View Assigned Projects</button>
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
    mysqli_close($connection);
}
?>
