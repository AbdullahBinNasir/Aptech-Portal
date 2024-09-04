<?php
require "../Connection/connection.php";
include "./Components/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $batch_id = $_POST['batch_id'];

    $sql = "SELECT s.submission_id, st.student_id, u.full_name AS student_name, a.title AS assignment_title, 
                   s.marks, s.feedback
            FROM submissions s
            INNER JOIN assignments a ON s.assignment_id = a.assignment_id
            INNER JOIN students st ON s.student_id = st.student_id
            INNER JOIN users u ON st.email = u.email
            WHERE a.batch_id = '$batch_id'";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Submission ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Assignment Title</th>
                    <th>Marks</th>
                    <th>Feedback</th>
                </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['submission_id']}</td>
                    <td>{$row['student_id']}</td>
                    <td>{$row['student_name']}</td>
                    <td>{$row['assignment_title']}</td>
                    <td>{$row['marks']}</td>
                    <td>{$row['feedback']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No grades available for this course.";
    }

    $connection->close();
}
?>

<form method="POST" action="">
    Course ID: <input type="text" name="batch_id" required><br>
    <input type="submit" value="View Grades">
</form>
