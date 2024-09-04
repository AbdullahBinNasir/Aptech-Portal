<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    $profile = "SELECT u.*, h.* FROM users u INNER JOIN hr h ON u.email = h.email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {

            $class_id = $chosen_date = '';
            $attendance_data = ''; // Variable to store attendance records HTML

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $class_id = $_POST['class_id'];
                $chosen_date = $_POST['chosen_date'];

                $sql = "SELECT a.attendance_date, a.status, s.student_id, s.batch_id, u.full_name AS student_name, b.batch_name
                        FROM attendance a
                        JOIN students s ON a.student_id = s.student_id
                        JOIN users u ON s.email = u.email
                        JOIN batches b ON s.batch_id = b.batch_id
                        WHERE a.batch_id = $class_id AND a.attendance_date = '$chosen_date';";

                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $batch_name = $row['batch_name'];
                    $attendance_data .= "<h2 class='mt-5'>Attendance Records for Batch: $batch_name on $chosen_date</h2>";
                    $attendance_data .= "<table border='1' class='mt-5 data-table table stripe hover nowrap'>
                                <tr>
                                    <th class='table-plus datatable-nosort'>Attendance Date</th>
                                    <th>Student</th>
                                    <th>Status</th>
                                </tr>";
                    do {
                        $attendance_data .= "<tr>
                                    <td>" . $row['attendance_date'] . "</td>
                                    <td>" . $row['student_name'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                </tr>";
                    } while ($row = $result->fetch_assoc());
                    $attendance_data .= "</table>";
                } else {
                    $attendance_data = "No attendance records found for Class ID: $class_id on $chosen_date.";
                }
            }

            $sql_classes = "SELECT `batch_id`, `batch_name` FROM `batches`";
            $result_classes = $connection->query($sql_classes);

?>

            <body>

                <?php
                include "./Components/navbar.php";
                include "./Components/rightSidebar.php";
                include "./Components/leftSidebar.php";
                ?>

                <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                    <div class="pd-ltr-20 xs-pd-20-10">
                        <div class="min-height-200px">

                            <div class="page-header">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <label for="class_id">Select Class:</label>
                                    <select id="class_id" name="class_id" class="form-control">
                                        <?php
                                        if ($result_classes->num_rows > 0) {
                                            while ($row_class = $result_classes->fetch_assoc()) {
                                                $selected = ($class_id == $row_class['batch_id']) ? 'selected' : '';
                                                echo "<option value='" . $row_class['batch_id'] . "' $selected>" . $row_class['batch_name'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No classes found</option>";
                                        }
                                        ?>
                                    </select>
                                    <br><br>
                                    <label for="chosen_date">Choose Date:</label>
                                    <input type="date" id="chosen_date" name="chosen_date" class="form-control" value="<?php echo $chosen_date; ?>">
                                    <br><br>
                                    <button type="submit" class="btn btn-danger">Fetch Attendance</button>
                                </form>

                                <?php
                                echo $attendance_data; // Output attendance records HTML
                                ?>

                                <?php
                                // Close database connection
                                $connection->close();
                                ?>
                            </div>

                        </div>

                        <?php
                        include "./Components/footer.php";
                        ?>
                    </div>
                </div>
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
