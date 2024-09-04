<?php
session_start();
require "../Connection/connection.php";

if (isset($_POST['assign_project'])) {
    $group_id = $_POST['group_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $assigned_date = date('Y-m-d');
    $due_date = $_POST['due_date'];

    // Handle file upload
    $attachment = '';
    if (!empty($_FILES['attachment']['name'])) {
        $attachment = basename($_FILES['attachment']['name']);
        $target_dir = "../uploads/";
        $target_file = $target_dir . $attachment;

        move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file);
    }

    // Insert project
    $insertProject = "INSERT INTO projects (group_id, title, description, attachment, assigned_date, due_date) 
                     VALUES ('$group_id', '$title', '$description', '$attachment', '$assigned_date', '$due_date')";
    if (mysqli_query($connection, $insertProject)) {
        echo "Project assigned successfully!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<form method="POST" action="" enctype="multipart/form-data">
    <label for="group_id">Select Group:</label>
    <select name="group_id" id="group_id" required>
        <!-- Fetch and list groups from the database -->
    </select>

    <label for="title">Project Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="description">Project Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="due_date">Due Date:</label>
    <input type="date" name="due_date" id="due_date" required>

    <label for="attachment">Attachment:</label>
    <input type="file" name="attachment" id="attachment">

    <button type="submit" name="assign_project">Assign Project</button>
</form>
