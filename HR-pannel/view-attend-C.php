<?php
require "../Connection/connection.php";
include "./Components/header.php"; // Include your database connection script

$class_id = $chosen_date = '';
$attendance_data = ''; // Variable to store attendance records HTML

// Check if form is submitted and handle the input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input (assuming $class_id and $chosen_date are fetched from form inputs)
    $class_id = $_POST['class_id'];
    $chosen_date = $_POST['chosen_date'];

    // echo $chosen_date;

    // Query to fetch attendance records for a specific class on the chosen date
    $sql = "SELECT a.attendance_date, a.status, s.student_id  AS student_name
            FROM attendance a
            JOIN students s ON a.student_id = s.student_id
            WHERE a.batch_id = $class_id
            AND a.attendance_date = '$chosen_date'"; // Filtering by chosen date and class_id


    $sql = "SELECT a.attendance_date, a.status, s.student_id, u.full_name AS student_name FROM attendance a JOIN students s ON a.student_id = s.student_id JOIN users u ON s.email = u.email WHERE a.batch_id = $class_id AND a.attendance_date = '$chosen_date';"; // Filtering by chosen date and class_id

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Prepare HTML for attendance records table
        $attendance_data .= "<h2 class='mt-5'>Attendance Records for Class ID: $class_id on $chosen_date</h2>";
        $attendance_data .= "<table border='1' class='mt-5 data-table table stripe hover nowrap'>
                                <tr>
                                    <th class='table-plus datatable-nosort'>Attendance Date</th>
                                    <th>Student</th>
                                    <th>Status</th>
                                </tr>";
        while ($row = $result->fetch_assoc()) {
            $attendance_data .= "<tr>
                                    <td>" . $row['attendance_date'] . "</td>
                                    <td>" . $row['student_name'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                </tr>";
        }
        $attendance_data .= "</table>";
    } else {
        $attendance_data = "No attendance records found for Class ID: $class_id on $chosen_date.";
    }
}

// Query to fetch class IDs for dropdown
$sql_classes = "SELECT `batch_id`, `batch_name` FROM `batches`"; // Query to fetch class IDs and names
$result_classes = $connection->query($sql_classes);
?>

<!-- HTML Form -->
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

<!-- Display attendance records -->
<?php
echo $attendance_data; // Output attendance records HTML
?>

<?php
// Close database connection
$connection->close();
?>