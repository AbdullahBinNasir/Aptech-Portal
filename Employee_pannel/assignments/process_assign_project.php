<?php
// Include database connection
require "../Connection/connection.php";

session_start();

// Check if user is logged in
if (isset($_SESSION['username']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $group_id = $_POST['group_id'];
    $project_title = $_POST['project_title'];
    $description = $_POST['description'];
    $submission_date = $_POST['submission_date'];

    // Handle file upload
    $attachment = '';
    if (isset($_FILES['attachments']) && $_FILES['attachments']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['attachments']['name']);
        if (move_uploaded_file($_FILES['attachments']['tmp_name'], $uploadFile)) {
            $attachment = $uploadFile;
        }
    }

    // Prepare the SQL query to insert project details
    $query = "
        INSERT INTO projects (Group_Id, project_title, description, attachment, submission_date)
        VALUES (?, ?, ?, ?, ?)
    ";

    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param('issss', $group_id, $project_title, $description, $attachment, $submission_date);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Project assigned successfully.";
    } else {
        echo "Failed to assign project.";
    }

    $stmt->close();
    $connection->close();
}
?>
