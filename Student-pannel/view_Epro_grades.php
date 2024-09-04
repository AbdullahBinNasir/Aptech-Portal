<?php
session_start();
require "../Connection/connection.php";
include "./Components/header.php";

if (isset($_SESSION['username'])) {

    // Fetch profile information
    $profile = "SELECT u.*, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add appropriate meta tags, title, and stylesheet links here -->
    <link rel="stylesheet" href="vendors/styles/style.css">
</head>

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

    <!-- Right Sidebar starts Here -->
    <?php
    include "./Components/rightSidebar.php";
    ?>
    <!-- Right Sidebar Ends Here -->

    <!-- Left Sidebar starts Here -->
    <?php
    include "./Components/leftSidebar.php";
    ?>
    <!-- Left Sidebar Ends Here -->

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <h4 class="text-blue mb-20">Grades for E-Projects</h4>
                </div>

                <!-- Display Grades Table -->
                <?php
                // Query to fetch all grades with project and group details
                $query = "
                    SELECT g.grade, g.comments, g.group_id, g.project_id, p.title AS project_title, gr.group_name
                    FROM grades g
                    INNER JOIN projects p ON g.project_id = p.project_id
                    INNER JOIN groups gr ON g.group_id = gr.group_id
                    ORDER BY g.group_id, g.project_id
                ";

                $result = mysqli_query($connection, $query);

                if (!$result) {
                    echo "Error fetching grades: " . mysqli_error($connection);
                    exit;
                }

                if (mysqli_num_rows($result) > 0) {
                    echo "<table border='1'>
                            <tr>
                                <th>Group Name</th>
                                <th>Project Title</th>
                                <th>Grade</th>
                                <th>Comments</th>
                            </tr>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['group_name']}</td>
                                <td>{$row['project_title']}</td>
                                <td>{$row['grade']}</td>
                                <td>{$row['comments']}</td>
                            </tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "No grades found.";
                }

                // Close the database connection
                mysqli_close($connection);
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
}
?>
