<?php

require "../Connection/connection.php";
include "./Components/header.php";
session_start();
if (isset($_SESSION['username'])) {

    // $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
    $profile = "SELECT u.*, e.*, u.user_id as fac_id FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";

    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {
            $facult_id = $data['fac_id'];
?>

            <body>
                <!-- Top Navbar -->
                <?php include "./Components/navbar.php"; ?>

                <!-- Right Sidebar -->
                <?php include "./Components/rightSidebar.php"; ?>

                <!-- Left Sidebar -->
                <?php include "./Components/leftSidebar.php"; ?>

                <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                    <div class="pd-ltr-20 xs-pd-20-10">
                        <div class="min-height-200px">
                            <!-- Page Header -->
                            <div class="page-header">
                                <h1>Create Group <?php echo $data['fac_id'] ?> </h1>
                                <p>Select a batch, then create a group and assign a team leader.</p>
                            </div>

                            <!-- Group Creation Form -->
                            <form method="POST" action="">
                                <!-- Fetching Batches -->
                                <div class="form-group">
                                    <label for="batch_id">Select Batch:</label>
                                    <select name="batch_id" id="batch_id" class="form-control" required onchange="this.form.submit();">
                                        <option value="">Select Batch</option>
                                        <?php
                                        // Query to fetch batches
                                        $queryBatches = "SELECT batch_id, batch_name, assigned_faculty FROM batches where assigned_faculty = $facult_id";
                                        $resultBatches = mysqli_query($connection, $queryBatches);

                                        if ($resultBatches) {
                                            while ($batch = mysqli_fetch_assoc($resultBatches)) {
                                                // Keep the selected batch option selected after the form submission
                                                $selected = (isset($_POST['batch_id']) && $_POST['batch_id'] == $batch['batch_id']) ? 'selected' : '';
                                                echo "<option value='{$batch['batch_id']}' $selected>{$batch['batch_name']}</option>";
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($connection);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>

                            <form method="POST" action="process_create_group.php">
                                <!-- Hidden field to pass the batch_id -->
                                <input type="hidden" name="batch_id" value="<?php echo isset($_POST['batch_id']) ? $_POST['batch_id'] : ''; ?>">

                                <!-- Group Name -->
                                <div class="form-group">
                                    <label for="group_name">Group Name:</label>
                                    <input type="text" name="group_name" id="group_name" class="form-control" required>
                                </div>

                                <?php if (isset($_POST['batch_id'])): ?>
                                    <!-- Fetching Students for Team Leader -->
                                    <div class="form-group">
                                        <label for="team_leader_id">Select Team Leader: <?php echo htmlspecialchars($_POST['batch_id']); ?> </label>
                                        <select name="team_leader_id" id="team_leader_id" class="form-control" required>
                                            <option value="">Select Team Leader</option>
                                            <?php
                                            // Ensure $batch_id is properly assigned
                                            $batch_id = mysqli_real_escape_string($connection, $_POST['batch_id']);

                                            // Query to fetch students for the selected batch
                                            $queryStudents = "
            SELECT u.user_id, u.full_name 
            FROM users u
            INNER JOIN students s ON u.email = s.email
            WHERE u.role = 'Student' AND s.batch_id = '$batch_id';
        ";

                                            $resultStudents = mysqli_query($connection, $queryStudents);

                                            if ($resultStudents) {
                                                while ($student = mysqli_fetch_assoc($resultStudents)) {
                                                    echo "<option value='{$student['user_id']}'>{$student['full_name']}</option>";
                                                }
                                            } else {
                                                echo "<option value=''>Error fetching students: " . mysqli_error($connection) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="student_ids">Select Group Members: <?php echo htmlspecialchars($batch_id); ?></label>
                                        <?php
                                        // Sanitize $batch_id to prevent SQL injection
                                        $batch_id = mysqli_real_escape_string($connection, $batch_id);

                                        // Query to fetch students for group members
                                        $queryStudents = "
        SELECT u.user_id, u.full_name 
        FROM users u
        INNER JOIN students s ON u.email = s.email
        WHERE u.role = 'Student' AND s.batch_id = '$batch_id'
    ";

                                        $resultStudents = mysqli_query($connection, $queryStudents);

                                        if ($resultStudents) {
                                            // Fetch and display the students as checkboxes
                                            while ($student = mysqli_fetch_assoc($resultStudents)) {
                                                echo "<div class='form-check'>";
                                                echo "<input type='checkbox' name='student_ids[]' value='{$student['user_id']}' class='form-check-input' id='student_{$student['user_id']}'>";
                                                echo "<label class='form-check-label' for='student_{$student['user_id']}'>";
                                                echo htmlspecialchars($student['full_name']);
                                                echo "</label>";
                                                echo "</div>";
                                            }
                                        } else {
                                            // Handle query error
                                            echo "<p class='text-danger'>Error fetching students: " . mysqli_error($connection) . "</p>";
                                        }
                                        ?>
                                    </div>



                                <?php endif; ?>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" name="create_group" class="btn btn-danger">Create Group</button>
                                </div>
                            </form>
                        </div>

                        <!-- Footer -->
                        <?php include "./Components/footer.php"; ?>
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