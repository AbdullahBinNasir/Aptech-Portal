<?php

// Start session
session_start();

// Database connection
require "../Connection/connection.php";
include "./Components/header.php";

// Initialize variables
$can_submit = false;

// Check if the user is logged in
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {

    // Get the user's profile details
    $profile = "SELECT u.*, u.user_id as studentid, s.*, b.*, emp.* 
                FROM users u 
                INNER JOIN students s ON u.email = s.email 
                INNER JOIN batches b ON s.batch_id = b.batch_id 
                LEFT JOIN employees emp ON u.email = emp.email 
                WHERE u.email = '" . $_SESSION['email'] . "';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        $data = mysqli_fetch_assoc($get_Pic);

        // Assuming student_id and faculty_id are stored in the database
        $student_id = $data['studentid'];
        $faculty_id = $data['assigned_faculty']; // Replace with actual faculty ID
        $bat_id = $data['batch_id'];
        // Get the current date
        $current_month = date('Y-m');

        // Query to check if the user has already submitted feedback this month
        $check_feedback_query = "SELECT * FROM faculty_feedback WHERE student_id = $student_id AND faculty_id = $faculty_id AND DATE_FORMAT(feedback_date, '%Y-%m') = '$current_month'";
        $check_feedback_result = mysqli_query($connection, $check_feedback_query);

        if (mysqli_num_rows($check_feedback_result) > 0) {
            // User has already submitted feedback this month
            $can_submit = false;
        } else {
            // User has not submitted feedback this month
            $can_submit = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Feedback Form</title>
</head>

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
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Faculty Feedback Form</h4>
                </div>

                <div class="min-height-200px">
                    <div class="page-header">
                        <div class="pb-20">
                            <h2>Faculty Feedback Form</h2>

                            <?php if ($can_submit): ?>
                                <form action="" method="POST">

                                    <!-- <input type="text"> -->
                                    <!-- Form Fields Here -->
                                    <label>1. Do Class Start And End On Time?  <?php //echo $student_id ?></label><br>
                                    <input type="radio" name="class_timing" value="4" required> Every Class<br>
                                    <input type="radio" name="class_timing" value="3"> Most Of The Classes<br>
                                    <input type="radio" name="class_timing" value="2"> Rarely<br>
                                    <input type="radio" name="class_timing" value="1"> Never<br>
                                    <br>
                                    <label>2. For The Chapters Covered To Date; Has Faculty Covered All Topics?</label><br>
                                    <input type="radio" name="covered_topics" value="4" required> Yes<br>
                                    <input type="radio" name="covered_topics" value="1"> No<br>
                                    <br>
                                    <label>3. Does Faculty Guide You During Your Lab Exercise?</label><br>
                                    <input type="radio" name="lab_guidance" value="4" required> Excellent<br>
                                    <input type="radio" name="lab_guidance" value="3"> Good<br>
                                    <input type="radio" name="lab_guidance" value="2"> Average<br>
                                    <input type="radio" name="lab_guidance" value="1"> Fair<br>
                                    <br>
                                    <label>4. Does The Faculty Teach Concepts Clearly and Answer Your Questions to Your Satisfaction?</label><br>
                                    <input type="radio" name="clear_teaching" value="4" required> Excellent<br>
                                    <input type="radio" name="clear_teaching" value="3"> Good<br>
                                    <input type="radio" name="clear_teaching" value="2"> Average<br>
                                    <input type="radio" name="clear_teaching" value="1"> Fair<br>
                                    <br>
                                    <label>5. Are Exams & Assignments Taken On Monthly Basis And Timely Feedback & Result Provided?</label><br>
                                    <input type="radio" name="exams_assignments_timing" value="4" required> Yes<br>
                                    <input type="radio" name="exams_assignments_timing" value="1"> No<br>
                                    <br>
                                    <label>6. Are Books Utilized During Class?</label><br>
                                    <input type="radio" name="book_utilization" value="4" required> Every Class<br>
                                    <input type="radio" name="book_utilization" value="3"> Most Of The Classes<br>
                                    <input type="radio" name="book_utilization" value="2"> Rarely<br>
                                    <input type="radio" name="book_utilization" value="1"> Never<br>
                                    <br>
                                    <label>7. SAR Are Delivered To You?</label><br>
                                    <input type="radio" name="sar_delivery" value="4" required> Yes<br>
                                    <input type="radio" name="sar_delivery" value="1"> No<br>
                                    <br>
                                    <label>8. Your Complaints Regarding Computer Systems/ Software Are Handled Within A Reasonable Time?</label><br>
                                    <input type="radio" name="system_complaints" value="4" required> Yes<br>
                                    <input type="radio" name="system_complaints" value="1"> No<br>
                                    <br>
                                    <input type="submit" name="feed" class="btn btn-danger" value="Submit">
                                </form>
                            <?php else: ?>
                                <p>You have already submitted feedback this month. You can submit again next month.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Footer Starts Here -->
                <?php
                include "./Components/footer.php";
                ?>
                <!-- Footer Ends Here -->
            </div>
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feed']) && $can_submit) {
    // Collect data from the form
    $class_timing = $_POST['class_timing'];
    $covered_topics = $_POST['covered_topics'];
    $lab_guidance = $_POST['lab_guidance'];
    $clear_teaching = $_POST['clear_teaching'];
    $exams_assignments_timing = $_POST['exams_assignments_timing'];
    $book_utilization = $_POST['book_utilization'];
    $sar_delivery = $_POST['sar_delivery'];
    $system_complaints = $_POST['system_complaints'];
    $feedback_date = date('Y-m-d');

    // Insert data into the database
    $sql = "INSERT INTO faculty_feedback (student_id, faculty_id, class_timing, covered_topics, lab_guidance, clear_teaching, exams_assignments_timing, book_utilization, sar_delivery, system_complaints, feedback_date) 
            VALUES ($student_id, $faculty_id, '$class_timing', '$covered_topics', '$lab_guidance', '$clear_teaching', '$exams_assignments_timing', '$book_utilization', '$sar_delivery', '$system_complaints', '$feedback_date')";

    if (mysqli_query($connection, $sql)) {
        // Calculate GPA for each question
        $gpa_query = "SELECT 
                        AVG(class_timing) as gpa_class_timing, 
                        AVG(covered_topics) as gpa_covered_topics, 
                        AVG(lab_guidance) as gpa_lab_guidance, 
                        AVG(clear_teaching) as gpa_clear_teaching, 
                        AVG(exams_assignments_timing) as gpa_exams_assignments_timing, 
                        AVG(book_utilization) as gpa_book_utilization, 
                        AVG(sar_delivery) as gpa_sar_delivery, 
                        AVG(system_complaints) as gpa_system_complaints 
                      FROM faculty_feedback 
                      WHERE faculty_id = $faculty_id AND DATE_FORMAT(feedback_date, '%Y-%m') = '$current_month'";

        $gpa_result = mysqli_query($connection, $gpa_query);

        if (mysqli_num_rows($gpa_result) > 0) {
            $gpa_data = mysqli_fetch_assoc($gpa_result);

            // Calculate total GPA
            $total_gpa = (
                $gpa_data['gpa_class_timing'] + 
                $gpa_data['gpa_covered_topics'] + 
                $gpa_data['gpa_lab_guidance'] + 
                $gpa_data['gpa_clear_teaching'] + 
                $gpa_data['gpa_exams_assignments_timing'] + 
                $gpa_data['gpa_book_utilization'] + 
                $gpa_data['gpa_sar_delivery'] + 
                $gpa_data['gpa_system_complaints']
            ) / 8;

            // Store GPA in the database
            $store_gpa_query = "INSERT INTO faculty_gpa (faculty_id, gpa_class_timing, gpa_covered_topics, gpa_lab_guidance, gpa_clear_teaching, gpa_exams_assignments_timing, gpa_book_utilization, gpa_sar_delivery, gpa_system_complaints, total_gpa, gpa_date, student_ID, batch_ID)
                                VALUES ($faculty_id, {$gpa_data['gpa_class_timing']}, {$gpa_data['gpa_covered_topics']}, {$gpa_data['gpa_lab_guidance']}, {$gpa_data['gpa_clear_teaching']}, {$gpa_data['gpa_exams_assignments_timing']}, {$gpa_data['gpa_book_utilization']}, {$gpa_data['gpa_sar_delivery']}, {$gpa_data['gpa_system_complaints']}, $total_gpa, '$feedback_date', '$student_id', '$bat_id')";

            if (mysqli_query($connection, $store_gpa_query)) {
                echo "<p>GPA calculated and stored successfully!</p>";
            } else {
                echo "<p>Error storing GPA: " . mysqli_error($connection) . "</p>";
                echo "<p>SQL Query: " . $store_gpa_query . "</p>";
            }
        } else {
            echo "<p>Error calculating GPA: No records found for the faculty in this month.</p>";
        }

    } else {
        // Debugging SQL error
        echo "<p>Error: " . mysqli_error($connection) . "</p>";
        echo "<p>SQL Query: " . $sql . "</p>";
    }
}
