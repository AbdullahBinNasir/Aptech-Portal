<?php
require "../connection/connection.php";
include "./Components/header.php";


$batches = [];
$students = [];
$selected_batch_id = null;
$message = "";

// Fetch batches
$sql = "SELECT * FROM batches";
$result = $connection->query($sql);
while ($row = $result->fetch_assoc()) {
    $batches[] = $row;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['select_batch'])) {
        $selected_batch_id = $_POST['batch_id'];

        // Fetch students for the selected batch
        $sql = "SELECT s.*, u.* FROM students s INNER JOIN users u ON s.email = u.email WHERE batch_id = $selected_batch_id";
        $result = $connection->query($sql);
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    } elseif (isset($_POST['mark_attendance'])) {
        $student_ids = $_POST['student_ids'];
        $selected_Bth_ids = $_POST['bth_ids'];
        $date = date("Y-m-d");

        foreach ($student_ids as $student_id) {
            $status = $_POST["status_$student_id"];
            $sql = "INSERT INTO attendance (`student_id`,`batch_id`, `attendance_date`, status) VALUES ($student_id, $selected_Bth_ids , '$date', '$status')";
            $connection->query($sql);
        }
        $message = "Attendance marked successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
</head>
<body>
    <h1>Mark Attendance</h1>

    <!-- Display success message -->
    <?php if ($message) { echo "<p>$message</p>"; } ?>

    <!-- Batch selection form -->
    <form method="post">
        <h2>Select Batch</h2>
        <select name="batch_id">
            <?php foreach ($batches as $batch) { ?>
                <option value="<?php echo $batch['batch_id']; ?>" <?php if ($selected_batch_id == $batch['batch_name']) echo 'selected'; ?>><?php echo $batch['batch_name']; ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="select_batch" value="View Students">
    </form>

    <!-- Display students if a batch is selected -->
    <?php if ($students) { ?>
    <form method="post">
        <h2>Students in Batch</h2>
        <table>
            <tr>
                <th>Student Name</th>
                <th>Status</th>
            </tr>
            <?php foreach ($students as $student) { ?>
            <tr>
                <td><?php echo $student['full_name']; ?></td>
                <td>
                    <input type="hidden" name="student_ids[]" value="<?php echo $student['student_id']; ?>">
                    <input type="hidden" name="bth_ids" value="<?php echo $student['batch_id']; ?>">
                    <select name="status_<?php echo $student['student_id']; ?>">
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </td>
            </tr>
            <?php } ?>
        </table>
        <input type="submit" name="mark_attendance" value="Submit Attendance">
    </form>
    <?php } ?>

</body>
</html>
