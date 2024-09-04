<?php
session_start();
require "../Connection/connection.php";
include "./Components/header.php";

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $email = $_SESSION['email'];

    // Fetch user profile data
    $profileQuery = "
        SELECT u.*, a.* 
        FROM users u 
        INNER JOIN admins a ON u.email = a.user_email 
        WHERE u.email = ?
    ";
    $stmt = $connection->prepare($profileQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $profileResult = $stmt->get_result();

    if ($profileResult->num_rows > 0) {
        $data = $profileResult->fetch_assoc();
?>

        <body>
            <!-- Pre-loader  Starts-->
            <?php // include "./Components/Preloader.php"; 
            ?>
            <!-- Pre-loader  Ends-->

            <!-- top-navbar Starts Here -->
            <?php include "./Components/navbar.php"; ?>
            <!-- top-navbar Ends Here -->

            <!-- Right Sidebar starts Here...! -->
            <?php include "./Components/rightSidebar.php"; ?>
            <!-- Right Sidebar Ends Here...! -->

            <!-- Left Sidebar starts Here...! -->
            <?php include "./Components/leftSidebar.php"; ?>
            <!-- Left Sidebar Ends Here...! -->

            <div class="mobile-menu-overlay"></div>

            <div class="main-container">
                <div class="pd-ltr-20 xs-pd-20-10">
                    <div class="min-height-200px">
                        <div class="page-header">
                            <h1>Assign Marks to E-project</h1>
                            <p>Evaluate and record grades for ongoing projects.</p>


                            <!-- Group and Project Form Starts Here -->
                            <?php
                            // Fetch all groups for the group selection dropdown
                            function fetchGroups($connection)
                            {
                                $queryGroups = "SELECT group_id, group_name FROM groups";
                                $resultGroups = mysqli_query($connection, $queryGroups);

                                if (!$resultGroups) {
                                    echo "Error fetching groups: " . htmlspecialchars(mysqli_error($connection));
                                    exit;
                                }

                                return $resultGroups;
                            }

                            // Fetch projects based on the selected group
                            function fetchProjects($connection, $group_id)
                            {
                                $stmt = $connection->prepare("
                                SELECT p.project_id, p.title
                                FROM projects p
                                INNER JOIN e_submissions es ON p.project_id = es.project_id
                                WHERE es.group_id = ?
                            ");
                                $stmt->bind_param("i", $group_id);
                                $stmt->execute();
                                return $stmt->get_result();
                            }

                            // Handle grade assignment
                            function assignGrade($connection, $project_id, $group_id, $grade, $comments)
                            {
                                $stmt = $connection->prepare("
                                INSERT INTO grades (project_id, group_id, grade, comments) 
                                VALUES (?, ?, ?, ?)
                            ");
                                $stmt->bind_param("iiss", $project_id, $group_id, $grade, $comments);

                                if ($stmt->execute()) {
                                    echo "Grade assigned successfully!";
                                } else {
                                    echo "Error: " . htmlspecialchars($stmt->error);
                                }
                            }

                            // Fetch all groups
                            $resultGroups = fetchGroups($connection);

                            // Initialize the projects options variable
                            $projectsOptions = '';
                            if (isset($_POST['group_id'])) {
                                $group_id = (int) $_POST['group_id'];
                                $resultProjects = fetchProjects($connection, $group_id);

                                if ($resultProjects->num_rows > 0) {
                                    while ($project = $resultProjects->fetch_assoc()) {
                                        $projectsOptions .= "<option value='" . htmlspecialchars($project['project_id']) . "'>" . htmlspecialchars($project['title']) . "</option>";
                                    }
                                } else {
                                    $projectsOptions = "<option>No projects found for the selected group.</option>";
                                }
                            }

                            // Handle grade assignment
                            if (isset($_POST['assign_grade'])) {
                                $project_id = (int) $_POST['project_id'];
                                $group_id = (int) $_POST['group_id'];
                                $grade = trim($_POST['grade']);
                                $comments = trim($_POST['comments']);

                                assignGrade($connection, $project_id, $group_id, $grade, $comments);
                            }
                            ?>

                            <form method="POST" action="">
                                <label for="group_id">Select Group:</label>
                                <select name="group_id" id="group_id" onchange="this.form.submit()" required class="form-control">
                                    <option value="">Select a group</option>
                                    <?php
                                    // Output all groups as options
                                    while ($group = mysqli_fetch_assoc($resultGroups)) {
                                        $selected = (isset($_POST['group_id']) && $_POST['group_id'] == $group['group_id']) ? "selected" : "";
                                        echo "<option value='" . htmlspecialchars($group['group_id']) . "' $selected>" . htmlspecialchars($group['group_name']) . "</option>";
                                    }
                                    ?>
                                </select><br>

                                <?php if (isset($_POST['group_id'])): ?>
                                    <label for="project_id">Select Project:</label>
                                    <select name="project_id" id="project_id" required class="form-control">
                                        <?php echo $projectsOptions; ?>
                                    </select><br>
                                <?php endif; ?>

                                <label for="grade">Grade:</label>
                                <input type="text" name="grade" id="grade" class="form-control" required><br>

                                <label for="comments">Comments:</label>
                                <textarea name="comments" id="comments" class="form-control"></textarea><br>

                                <button type="submit" name="assign_grade" class="btn btn-danger">Assign Grade</button>
                            </form>
                            <!-- Group and Project Form Ends Here -->
                        </div>
                    </div>

                    <!-- Footer Starts Here -->
                    <?php include "./Components/footer.php"; ?>
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
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

// Close the database connection
mysqli_close($connection);
?>