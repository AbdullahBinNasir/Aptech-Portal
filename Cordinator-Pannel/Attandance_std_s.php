<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	// $profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $profile = "SELECT u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";
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

				<!-- Right Sidebar starts Here...! -->
				<?php
				include "./Components/rightSidebar.php";
				?>
				<!-- Right Sidebar Ends Here...! -->

				<!-- Left Sidebar starts Here...! -->
				<?php
				include "./Components/leftSidebar.php";
				


// Check if form is submitted and handle the input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $chosen_month = trim($_POST['chosen_month']);
    $student_id = trim($_POST['student_id']);

    // Check if inputs are not empty
    if (!empty($chosen_month) && !empty($student_id)) {
        // Ensure student_id is an integer
        if (filter_var($student_id, FILTER_VALIDATE_INT) !== false) {
            // Prepare the SQL statement
            $stmt = $connection->prepare(
                "SELECT a.attendance_date, a.status, b.batch_name AS class_name
                FROM attendance a
                JOIN batches b ON a.batch_id = b.batch_id
                WHERE a.student_id = ? AND DATE_FORMAT(a.attendance_date, '%Y-%m') = ?"
            );
            $stmt->bind_param("is", $student_id, $chosen_month);

            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $attendance_records = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $error_message = "No attendance records found for Student ID: $student_id in $chosen_month.";
            }
            $stmt->close();
        } else {
            $error_message = "Invalid Student ID.";
        }
    } else {
        $error_message = "Both month and student ID are required.";
    }

    $connection->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            margin-top: 10px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- top-navbar Starts Here -->
   

    <div class="mobile-menu-overlay"></div>
        <div class="main-container">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="container">
                            <h2 class="mb-4">Fetch Attendance Records Of Particular Student</h2>
                            <form method="post">
                                <div class="form-group">
                                    <label for="chosen_month">Choose Month:</label>
                                    <input type="month" id="chosen_month" name="chosen_month" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="student_id">Student ID:</label>
                                    <input type="text" id="student_id" name="student_id" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-danger">Fetch Attendance</button>
                            </form>

                            <?php if (isset($attendance_records)): ?>
                                <h2 class="mt-4">Attendance Records for Student ID: <?= htmlspecialchars($student_id) ?> in <?= htmlspecialchars($chosen_month) ?></h2>
                                <table class="table table-bordered mt-4">
                                    <thead>
                                        <tr>
                                            <th>Attendance Date</th>
                                            <th>Class</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($attendance_records as $record): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($record['attendance_date']) ?></td>
                                                <td><?= htmlspecialchars($record['class_name']) ?></td>
                                                <td><?= htmlspecialchars($record['status']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php elseif (isset($error_message)): ?>
                                <div class="alert alert-warning">
                                    <?= htmlspecialchars($error_message) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Footer Starts Here -->
                <?php include "./Components/footer.php"; ?>
                <!-- Footer Ends Here -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Additional JS -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>
<?php
        }}}
        ?>