<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    $profile = "SELECT u.user_id as facultyid, u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {

            $batches = [];
            $assignments = [];
            $students = [];
            $selected_batch_id = null;
            $selected_assignment_id = null;
            $message = "";

            // Fetch batches
            $sql = "SELECT * FROM `batches` WHERE assigned_faculty = '" . $data['facultyid'] . "';";
            $result = $connection->query($sql);
            while ($row = $result->fetch_assoc()) {
                $batches[] = $row;
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['select_batch'])) {
                    $selected_batch_id = $_POST['batch_id'];

                    // Fetch assignments for the selected batch
                    $sql = "SELECT * FROM assignments WHERE batch_id = $selected_batch_id";
                    $result = $connection->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $assignments[] = $row;
                    }
                } elseif (isset($_POST['select_assignment'])) {
                    $selected_batch_id = $_POST['batch_id'];
                    $selected_assignment_id = $_POST['assignment_id'];

                    // Fetch students for the selected batch and assignment
                    // $sql = "SELECT u.*, s.*, u.user_id as my_id, a.assignment_id, sub.file_path, sub.submission_date FROM students s, users u JOIN submissions sub ON u.user_id = sub.student_id JOIN assignments a ON a.assignment_id = sub.assignment_id WHERE s.batch_id = $selected_batch_id AND a.assignment_id = $selected_assignment_id;";
                    $sql = "SELECT u.*, sub.* FROM users u INNER JOIN `submissions` sub on u.user_id = sub.student_id WHERE assignment_id = $selected_assignment_id AND Assigned_batch =  $selected_batch_id;";
                    $result = $connection->query($sql);

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $students[] = $row;
                        }
                    } else {
                        echo "Error: " . $connection->error;
                    }
                } elseif (isset($_POST['assign_marks'])) {
                    $student_ids = $_POST['student_ids'];
                    $selected_batch_id = $_POST['batch_id'];
                    $selected_assignment_id = $_POST['assignment_id'];

                    foreach ($student_ids as $student_id) {
                        $marks = $_POST["marks_$student_id"];
                        $feedback = $_POST["feedback_$student_id"];

                        // Check if the student already has a submission entry
                        $sql_check = "SELECT * FROM submissions WHERE student_id = $student_id AND assignment_id = $selected_assignment_id";
                        $result_check = $connection->query($sql_check);

                        if ($result_check->num_rows > 0) {
                            // Update existing submission
                            $sql = "UPDATE submissions SET marks = '$marks', feedback = '$feedback' WHERE student_id = $student_id AND assignment_id = $selected_assignment_id";
                        } else {
                            // Insert new submission
                            $sql = "INSERT INTO submissions (`student_id`, `assignment_id`, `marks`, `feedback`) VALUES ($student_id, $selected_assignment_id, '$marks', '$feedback')";
                        }

                        if ($connection->query($sql) === TRUE) {
                            $message = "Marks assigned successfully!";
                        } else {
                            $message = "Error: " . $sql . "<br>" . $connection->error;
                        }
                    }
                }
            }
?>

            <body>
            <link rel="stylesheet" href="./src/styles/style1.css">
                <!-- Pre-loader Starts-->
                <?php
                // include "./Components/Preloader.php";
                ?>
                <!-- Pre-loader Ends-->

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
                                <h1>Assign Marks</h1>

                                <!-- Display success message -->
                                <?php if ($message) {
                                    echo "<p>$message</p>";
                                } ?>

                                <!-- Batch selection form -->
                                <form method="post">
                                    <h2 class="mt-5">Select Batch</h2>
                                    <select name="batch_id" class="form-control my-3">
                                        <?php foreach ($batches as $batch) { ?>
                                            <option value="<?php echo $batch['batch_id']; ?>" <?php if ($selected_batch_id == $batch['batch_id']) echo 'selected'; ?>><?php echo $batch['batch_name']; ?></option>
                                        <?php } ?>
                                    </select>

                                    <input type="submit" name="select_batch" value="Next" class="btn btn-danger">
                                </form>

                                <!-- Assignment selection form -->
                                <?php if ($assignments) { ?>
                                    <form method="post">
                                        <h2 class="mt-5">Select Assignment</h2>
                                        <select name="assignment_id" class="form-control my-3">
                                            <?php foreach ($assignments as $assignment) { ?>
                                                <option value="<?php echo $assignment['assignment_id']; ?>" <?php if ($selected_assignment_id == $assignment['assignment_id']) echo 'selected'; ?>><?php echo $assignment['title']; ?></option>
                                            <?php } ?>
                                        </select>

                                        <input type="hidden" name="batch_id" value="<?php echo $selected_batch_id; ?>">
                                        <input type="submit" name="select_assignment" value="View Students" class="btn btn-danger">
                                    </form>
                                <?php } ?>

                                <!-- Display students if an assignment is selected -->
                                <?php if ($students) { ?>
                                    <form method="post">
                                        <h2 class="mt-5">Students in Batch</h2>
                                        <table class="data-table table stripe hover nowrap mt-5">
                                            <tr>
                                                <th class="table-plus datatable-nosort">Student Name</th>
                                                <th class="datatable-nosort">Submitted File</th>
                                                <th class="datatable-nosort">Marks</th>
                                                <th class="datatable-nosort">Feedback</th>
                                            </tr>
                                            <?php foreach ($students as $student) { ?>
                                                <tr>
                                                    <td class="table-plus"><?php echo $student['full_name']; ?></td>
                                                    <td>
                                                        <?php if ($student['file_path']) {
                                                            $file_path = "../Employee_pannel/" . $student['file_path']; 
                                                            echo '<a href="' . htmlspecialchars($file_path, ENT_QUOTES, 'UTF-8') . '" target="_blank">View Submission</a>';
                                                        } else {
                                                            echo "No Submission";
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="student_ids[]" value="<?php echo $student['student_id']; ?>">
                                                        <input type="number" class='form-control' name="marks_<?php echo $student['student_id']; ?>" min="0" max="100" placeholder="Enter Marks" value="<?php echo $student['marks']?>">
                                                    </td>
                                                    <td>
                                                        <textarea class='form-control' name="feedback_<?php echo $student['student_id']; ?>" placeholder="Enter Feedback"><?php echo $student['feedback']?></textarea>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <input type="hidden" name="batch_id" value="<?php echo $selected_batch_id; ?>">
                                        <input type="hidden" name="assignment_id" value="<?php echo $selected_assignment_id; ?>">
                                        <input type="submit" name="assign_marks" value="Submit Marks" class="btn btn-danger">
                                    </form>
                                <?php } ?>
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
