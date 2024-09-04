<?php
// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // Prepare the query
    $profile = "SELECT 
                    u.*,  
                    s.*, 
                    b.batch_name,
                    faculty_user.full_name AS faculty_name
                FROM 
                    users u
                LEFT JOIN 
                    students s ON u.email = s.email
                LEFT JOIN 
                    batches b ON b.batch_id = s.batch_id
                LEFT JOIN 
                    users faculty_user ON b.assigned_faculty = faculty_user.user_id
                WHERE 
                    u.email = ?";

    // Prepare and execute the statement
    $stmt = $connection->prepare($profile);
    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $get_Pic = $stmt->get_result();

    if ($get_Pic->num_rows > 0) {
        while ($data = $get_Pic->fetch_assoc()) {
            // Store student ID in the session
            $_SESSION['student_id'] = $data['student_id'];
            $studentName = $data['full_name'];
            $batchName = $data['batch_name'];
            $facultyName = $data['faculty_name'];

         
            // header Starts here
            // require "../Connection/connection.php";
            // include "./Components/header.php";

            // session_start();
            if (isset($_SESSION['username'])) {

                $profile = "SELECT u.*, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";

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
                            ?>
                            <!-- Left Sidebar Ends Here...! -->


                            <div class="mobile-menu-overlay"></div>

                                <div class="main-container">
                                    <div class="pd-ltr-20 xs-pd-20-10">


                                        <div class="min-height-200px">



                                            <div class="page-header">


                                                <!DOCTYPE html>
                                                <html lang="en">

                                                <head>
                                                    <meta charset="UTF-8">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <title>Student Appraisal Report</title>
                                                    <style>
                                                        table {
                                                            border-collapse: collapse;
                                                            width: 100%;
                                                        }

                                                        th,
                                                        td {
                                                            border: 1px solid black;
                                                            padding: 8px;
                                                            text-align: left;
                                                        }

                                                        th {
                                                            background-color: #f2f2f2;
                                                        }
                                                    </style>
                                                </head>

                                                <body>
                                                    <h1>Student Appraisal Report</h1>
                                                    <p><strong>Student Name:</strong> <?= htmlspecialchars($studentName); ?></p>
                                                    <p><strong>Batch Name:</strong> <?= htmlspecialchars($batchName); ?></p>
                                                    <p><strong>Faculty Name:</strong> <?= htmlspecialchars($facultyName); ?></p>
                                                    <p><strong>Month:</strong> <?= htmlspecialchars(date('F Y', strtotime(date('Y-m')))); ?></p>

                                                    <h2>Attendance Records</h2>

                                                    <?php
                                                    // Initialize variables
                                                    $daysPresent = 0;
                                                    $totalDaysInMonth = 12; // Assuming a total of 12 possible attendance days
                                                    $attendanceWeight = 0.5; // 50% weight for attendance
                                                    $assignmentWeight = 0.5; // 50% weight for assignments
                                                    $currentMonth = date('Y-m');
                                                    $studentId = $_SESSION['student_id'];

                                                    if ($connection) {
                                                        // Fetch the number of days present for the current month
                                                        $sqlAttendance = "SELECT COUNT(*) as days_present FROM attendance WHERE student_id = ? AND attendance_date LIKE ? AND status = 'Present'";
                                                        $stmtAttendance = $connection->prepare($sqlAttendance);
                                                        if (!$stmtAttendance) {
                                                            die("Error preparing attendance statement: " . $connection->error);
                                                        }
                                                        $likeMonth = $currentMonth . '%';
                                                        $stmtAttendance->bind_param('is', $studentId, $likeMonth);
                                                        $stmtAttendance->execute();
                                                        $stmtAttendance->bind_result($daysPresent);
                                                        $stmtAttendance->fetch();
                                                        $stmtAttendance->close();

                                                        // Fetch the assignment marks
                                                        $sqlAssignments = "SELECT marks FROM submissions WHERE student_id = ?";
                                                        $stmtAssignments = $connection->prepare($sqlAssignments);
                                                        if (!$stmtAssignments) {
                                                            die("Error preparing assignments statement: " . $connection->error);
                                                        }
                                                        $stmtAssignments->bind_param('i', $studentId);
                                                        $stmtAssignments->execute();
                                                        $result = $stmtAssignments->get_result();
                                                        $totalMarks = 0;
                                                        $numAssignments = 0;
                                                        while ($row = $result->fetch_assoc()) {
                                                            $totalMarks += $row['marks'];
                                                            $numAssignments++;
                                                        }
                                                        $averageMarks = ($numAssignments > 0) ? ($totalMarks / $numAssignments) : 0;
                                                        $stmtAssignments->close();

                                                        // Calculate the attendance percentage
                                                        $attendancePercentage = ($daysPresent / $totalDaysInMonth) * 100;

                                                        // Overall percentage calculation
                                                        $overallPercentage = ($attendancePercentage * $attendanceWeight) + ($averageMarks * $assignmentWeight);
                                                    }
                                                    $connection->close();
                                                    ?>

                                                    <p><strong>Number of Days Present:</strong>
                                                        <?= htmlspecialchars($daysPresent . '/' . $totalDaysInMonth); ?></p>

                                                    <h2>Assignment Marks</h2>
                                                    <p><strong>Average Marks:</strong> <?= htmlspecialchars(number_format($averageMarks, 2)); ?>
                                                    </p>

                                                    <h2>Overall Percentage</h2>
                                                    <p><strong>Overall Percentage:</strong>
                                                        <?= htmlspecialchars(number_format($overallPercentage, 2)); ?>%</p>

                                                </body>

                                                </html>

                                                <?php
                    }
                } else {
                    echo "No data found for the specified email.";
                }

                // Close the statement
                $stmt->close();
            }
            ?>
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