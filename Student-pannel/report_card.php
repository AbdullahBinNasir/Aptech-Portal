<?php
// Database connection parameters
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
    $profile = "SELECT u.*, s.* FROM users u INNER JOIN students s ON u.email = s.email WHERE u.email = '" . $_SESSION['email'] . " ';";

    $get_Pic = mysqli_query($connection, $profile);


    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {



            // Get the student ID (you can modify this to fetch dynamically from a form or URL parameter)
            $student_id = 1; // For demonstration purposes, we'll use student_id = 1

            // SQL query to fetch the report card data
            $sql = "SELECT 
            s.name AS student_name,
            s.class,
            s.roll_number,
            a.title AS assignment_title,
            sub.submission_date,
            sub.grade
        FROM
            students s
        JOIN 
            submissions sub ON s.student_id = sub.student_id
        JOIN 
            assignments a ON sub.assignment_id = a.assignment_id
        WHERE 
            s.student_id = $student_id";

            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // Fetch the student's basic information from the first row
                $row = $result->fetch_assoc();
                echo "<h2>Report Card for " . $row['student_name'] . "</h2>";
                echo "<p>Class: " . $row['class'] . "</p>";
                echo "<p>Roll Number: " . $row['roll_number'] . "</p>";

                // Rewind the result set pointer
                $result->data_seek(0);

                echo "<table border='1'>";
                echo "<tr><th>Assignment</th><th>Submission Date</th><th>Grade</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['assignment_title'] . "</td>";
                    echo "<td>" . $row['submission_date'] . "</td>";
                    echo "<td>" . $row['grade'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No records found for the selected student.";
            }

            // Close the connection
            $connection->close();
        }
    }
}
