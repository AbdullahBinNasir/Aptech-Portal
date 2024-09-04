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

            $designation = $chosen_date = '';
            $attendance_data = ''; // Variable to store attendance records HTML

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $designation = $_POST['designation'];
                $chosen_date = $_POST['chosen_date'];

                $sql = "SELECT a.attendance_date, a.status, e.employee_id, u.full_name AS employee_name
                        FROM employee_attendance a
                        JOIN employees e ON a.employee_id = e.employee_id
                        JOIN users u ON e.email = u.email
                        WHERE e.designation = '$designation' AND a.attendance_date = '$chosen_date';";

                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    $attendance_data .= "<h2 class='mt-5'>Attendance Records for Designation: $designation on $chosen_date</h2>";
                    $attendance_data .= "<table border='1' class='mt-5 data-table table stripe hover nowrap'>
                                <tr>
                                    <th class='table-plus datatable-nosort'>Attendance Date</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                </tr>";
                    while ($row = $result->fetch_assoc()) {
                        $attendance_data .= "<tr>
                                    <td>" . $row['attendance_date'] . "</td>
                                    <td>" . $row['employee_name'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                </tr>";
                    }
                    $attendance_data .= "</table>";
                } else {
                    $attendance_data = "No attendance records found for Designation: $designation on $chosen_date.";
                }
            }

            $sql_designations = "SELECT DISTINCT `designation` FROM `employees`";
            $result_designations = $connection->query($sql_designations);

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
                                    <label for="designation">Select Designation:</label>
                                    <select id="designation" name="designation" class="form-control">
                                        <?php
                                        if ($result_designations->num_rows > 0) {
                                            while ($row_designation = $result_designations->fetch_assoc()) {
                                                $selected = ($designation == $row_designation['designation']) ? 'selected' : '';
                                                echo "<option value='" . $row_designation['designation'] . "' $selected>" . $row_designation['designation'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No designations found</option>";
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
