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

            $designations = [];
            $employees = [];
            $selected_designation = null;
            $message = "";

            // Fetch designations
            $sql = "SELECT DISTINCT designation FROM employees";
            $result = $connection->query($sql);
            while ($row = $result->fetch_assoc()) {
                $designations[] = $row;
            }

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['select_designation'])) {
                    $selected_designation = $_POST['designation'];

                    // Fetch employees for the selected designation
                    $sql = "SELECT e.*, u.* FROM employees e INNER JOIN users u ON e.email = u.email WHERE designation = '$selected_designation'";
                    $result = $connection->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $employees[] = $row;
                    }
                } elseif (isset($_POST['mark_attendance'])) {
                    $employee_ids = $_POST['employee_ids'];
                    $designation = $_POST['designation'];
                    $date = date("Y-m-d");

                    foreach ($employee_ids as $employee_id) {
                        $status = $_POST["status_$employee_id"];
                        $sql = "INSERT INTO employee_attendance (`employee_id`, `attendance_date`, `status`) VALUES ($employee_id, '$date', '$status')";
                        $connection->query($sql);
                    }
                    $message = "Attendance marked successfully!";
                }
            }
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
                                <h1>Mark Attendance</h1>

                                <!-- Display success message -->
                                <?php if ($message) {
                                    echo "<p>$message</p>";
                                } ?>

                                <!-- Designation selection form -->
                                <form method="post">
                                    <h2 class="mt-5">Select Designation</h2>
                                    <select name="designation" class="form-control my-3">
                                        <?php foreach ($designations as $designation) { ?>
                                            <option value="<?php echo $designation['designation']; ?>" <?php if ($selected_designation == $designation['designation']) echo 'selected'; ?>><?php echo $designation['designation']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="submit" name="select_designation" value="View Employees" class="btn btn-danger">
                                </form>

                                <!-- Display employees if a designation is selected -->
                                <?php if ($employees) { ?>
                                    <form method="post">
                                        <h2 class="mt-5">Employees in Designation</h2>
                                        <table class="data-table table stripe hover nowrap mt-5">
                                            <tr>
                                                <th class="table-plus datatable-nosort">Employee Name</th>
                                                <th class="datatable-nosort">Status</th>
                                            </tr>
                                            <?php foreach ($employees as $employee) { ?>
                                                <tr>
                                                    <td class="table-plus"><?php echo $employee['full_name']; ?></td>
                                                    <td>
                                                        <input type="hidden" name="employee_ids[]" value="<?php echo $employee['employee_id']; ?>">
                                                        <input type="hidden" name="designation" value="<?php echo $employee['designation']; ?>">
                                                        <select class='form-control' name="status_<?php echo $employee['employee_id']; ?>">
                                                            <option value="Present">Present</option>
                                                            <option value="Absent">Absent</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                        <input type="submit" name="mark_attendance" value="Submit Attendance" class="btn btn-danger">
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
