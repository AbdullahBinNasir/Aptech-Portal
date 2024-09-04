<?php
require "../Connection/connection.php";
include "./Components/header.php";

// Fetch students
$sql_students = "SELECT s.*, u.* FROM students s INNER JOIN users u ON s.email = u.email;";
$result_students = $connection->query($sql_students);

// Fetch classes
$sql_classes = "SELECT * FROM `batches`";
$result_classes = $connection->query($sql_classes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance System</title>
    <!-- Add any CSS links or styles here -->
</head>
<body>
    <h2>Mark Attendance</h2>
    <form action="submit_attendance.php" method="post">
        <label for="student">Select Student:</label>
        <select name="student" id="student" class="form-control">
            <?php
            while ($row_students = $result_students->fetch_assoc()) {
                echo "<option value='" . $row_students['student_id'] . "'>" . $row_students['full_name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="class">Select Class:</label>
        <select name="class" id="class">
            <?php
            while ($row_classes = $result_classes->fetch_assoc()) {
                echo "<option value='" . $row_classes['batch_id'] . "'>" . $row_classes['full_name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="status">Attendance Status:</label>
        <input type="radio" name="status" value="Present" checked> Present
        <input type="radio" name="status" value="Absent"> Absent
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
// Close connection
$connection->close();
?>
