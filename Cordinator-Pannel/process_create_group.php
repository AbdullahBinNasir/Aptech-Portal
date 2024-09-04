<?php
session_start();
require "../Connection/connection.php";

// Ensure form data is received
if (isset($_POST['batch_id']) && isset($_POST['team_leader_id']) && isset($_POST['student_ids'])) {
    // Sanitize and validate input
    $batch_id = mysqli_real_escape_string($connection, $_POST['batch_id']);
    $team_leader_id = mysqli_real_escape_string($connection, $_POST['team_leader_id']);
    $student_ids = $_POST['student_ids']; // This is an array of student IDs
    $Grpname = $_POST['group_name']; // This is an array of student IDs

    // Insert the new group into the database
    $insertGroupQuery = "
        INSERT INTO groups (batch_id, team_leader_id,group_name) 
        VALUES ('$batch_id', '$team_leader_id','$Grpname')
    ";
    $insertGroupResult = mysqli_query($connection, $insertGroupQuery);

    if ($insertGroupResult) {
        // Get the last inserted group ID
        $group_id = mysqli_insert_id($connection);

        // Insert selected students into the group
        foreach ($student_ids as $student_id) {
            $student_id = mysqli_real_escape_string($connection, $student_id);
            $insertStudentQuery = "
                INSERT INTO group_members (group_id, student_id) 
                VALUES ('$group_id', '$student_id')
            ";
            mysqli_query($connection, $insertStudentQuery);
        }

        echo "Group created successfully.";
        header('location: faculty_create_group.php');
    } else {
        echo "Error creating group: " . mysqli_error($connection);
    }
} else {
    echo "Invalid input.";
}

// Close the database connection
mysqli_close($connection);
?>
