<?php
// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the posted data
    $group_id = $_POST['group_id'];
    $project_title = $_POST['project_title'];
    $description = $_POST['description'];
    $submission_date = $_POST['submission_date'];

    // Handle file upload if any
    $attachments = null;
    if (isset($_FILES['attachments']) && $_FILES['attachments']['error'] == UPLOAD_ERR_OK) {
        $attachments = basename($_FILES["attachments"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $attachments;

        // Move uploaded file to the desired directory
        if (!move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }

    // Insert project details into the database
    $query = "
        INSERT INTO projects (group_id, project_title, description, attachment, submission_date)
        VALUES (?, ?, ?, ?, ?)
    ";

    $stmt = $connection->prepare($query);
    
    // Check if query preparation was successful
    if (!$stmt) {
        die("Preparation failed: (" . $connection->errno . ") " . $connection->error);
    }

    $stmt->bind_param('issss', $group_id, $project_title, $description, $attachments, $submission_date);

    if ($stmt->execute()) {
        // Update the is_Assigned column to 0 after successfully assigning the project
        $updateQuery = "
            UPDATE e_project_assignments
            SET is_Assigned = 0
            WHERE Group_Id = ?
        ";
        $updateStmt = $connection->prepare($updateQuery);
        
        // Check if query preparation was successful
        if (!$updateStmt) {
            die("Preparation failed: (" . $connection->errno . ") " . $connection->error);
        }

        $updateStmt->bind_param('i', $group_id);
        $updateStmt->execute();
        $updateStmt->close();

        echo "Project assigned successfully!";
        // header(location : 'View_E-Project_Requests.php' );
        header('Location: View_E-Project_Requests.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
