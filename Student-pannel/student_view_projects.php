<?php
// Session and Database Connection
session_start();
require "../Connection/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $group_id = mysqli_real_escape_string($connection, $_POST['group_id']);

    // Fetch projects assigned to the group
    $queryProjects = "
        SELECT p.project_id, p.title, p.description, p.due_date
        FROM projects p
        WHERE p.group_id = '$group_id'
    ";

    $resultProjects = mysqli_query($connection, $queryProjects);

    if (!$resultProjects) {
        echo "Error fetching projects: " . mysqli_error($connection);
        exit;
    }
} else {
    echo "Invalid request method.";
    exit;
}
?>

<?php
// Include Header
include "./Components/header.php";

// Check if user is logged in
if (isset($_SESSION['username'])) {

    // Fetch User Profile Information
    $profile = "SELECT u.*, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {
?>

            <body>

                <!-- Pre-loader Starts (if needed) -->
                <?php
                // include "./Components/Preloader.php";
                ?>
                <!-- Pre-loader Ends -->

                <!-- Top Navbar -->
                <?php
                include "./Components/navbar.php";
                ?>
                <!-- Top Navbar Ends -->

                <!-- Right Sidebar -->
                <?php
                include "./Components/rightSidebar.php";
                ?>
                <!-- Right Sidebar Ends -->

                <!-- Left Sidebar -->
                <?php
                include "./Components/leftSidebar.php";
                ?>
                <!-- Left Sidebar Ends -->

                <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                    <div class="pd-ltr-20 xs-pd-20-10">
                        <div class="min-height-200px">

                            <div class="page-header">
                                <h2 class="text-center">Assigned Projects</h2>
                                <p class="text-center">Here are the projects assigned to your group.</p>
                            </div>

                            <?php if (mysqli_num_rows($resultProjects) > 0): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Project Description</th>
                                            <th>Due Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($project = mysqli_fetch_assoc($resultProjects)): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($project['title']); ?></td>
                                                <td><?php echo htmlspecialchars($project['description']); ?></td>
                                                <td><?php echo htmlspecialchars($project['due_date']); ?></td>
                                                <td>
                                                    <a href="teamleader_submit_project.php?id=<?php echo $group_id; ?>" class="btn btn-danger">Submit</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-center">No projects assigned to this group.</p>
                            <?php endif; ?>

                        </div>

                        <!-- Footer -->
                        <?php
                        include "./Components/footer.php";
                        ?>
                        <!-- Footer Ends -->
                    </div>
                </div>

                <!-- JS Scripts -->
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
mysqli_close($connection);
?>
