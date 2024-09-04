<?php
// Start the session
session_start();

// Include the database connection and header files
require "../Connection/connection.php";
include "./Components/header.php";

// Check if the user is logged in
if (isset($_SESSION['username'])) {
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
                    <h1>Create Group</h1>
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
                            $queryBatches = "SELECT batch_id, batch_name FROM batches";
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
                            <label for="team_leader_id">Select Team Leader:</label>
                            <select name="team_leader_id" id="team_leader_id" class="form-control" required>
                                <option value="">Select Team Leader</option>
                                <?php
                                // Query to fetch students
                                $batch_id = $_POST['batch_id'];
                                $queryStudents = "SELECT user_id, name FROM users WHERE role = 'student' AND user_id IN 
                                                    (SELECT student_id FROM students WHERE batch_id = '$batch_id')";
                                $resultStudents = mysqli_query($connection, $queryStudents);

                                if ($resultStudents) {
                                    while ($student = mysqli_fetch_assoc($resultStudents)) {
                                        echo "<option value='{$student['user_id']}'>{$student['name']}</option>";
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($connection);
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Fetching Students for Group Members -->
                        <div class="form-group">
                            <label for="student_ids">Select Group Members:</label>
                            <select name="student_ids[]" id="student_ids" class="form-control" multiple required>
                                <option value="">Select Group Members</option>
                                <?php
                                // Query to fetch students
                                if ($resultStudents) {
                                    mysqli_data_seek($resultStudents, 0); // Reset pointer for reuse
                                    while ($student = mysqli_fetch_assoc($resultStudents)) {
                                        echo "<option value='{$student['user_id']}'>{$student['name']}</option>";
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($connection);
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" name="create_group" class="btn btn-primary">Create Group</button>
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
} else {
    echo "<p class='alert alert-warning'>Please log in to create groups.</p>";
}
?>
    