<?php
require "../Connection/connection.php";
include "./Components/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assignment_id = $_POST['assignment_id'];
    $student_id = $_POST['student_id'];
    $submission_date = date("Y-m-d");
    $batch_id = $_POST['batch_id'];
    $file_path = "assignments/" . basename($_FILES["assignment_file"]["name"]);

    // Upload file
    if (move_uploaded_file($_FILES["assignment_file"]["tmp_name"], $file_path)) {
        $sql = "INSERT INTO submissions (assignment_id, student_id, submission_date, file_path, Assigned_batch)
                VALUES ('$assignment_id', '$student_id', '$submission_date', '$file_path', '$batch_id')";

        if ($connection->query($sql) === TRUE) {
            echo "Assignment submitted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $connection->close();
}
?>

<form method="POST" action="" enctype="multipart/form-data">


        <select name="assignment_id" id="batch_ID" class="form-control my-3 red-input">
            <option value="" disabled selected>Select Assignment</option>
            <?php
            $getassignment = "SELECT * from `assignments`";
            $getassignment_run = mysqli_query($connection, $getassignment) or die("failed to get categories");
            if (mysqli_num_rows($getassignment_run) > 0) {
                while ($assignment = mysqli_fetch_assoc($getassignment_run)) {
                    echo '<option value="' . $assignment['assignment_id'] . '" >' . $assignment['title'] . '</option>';
                }
            }


            ?>
 
    <!-- Assignment ID: <input type="text" name="assignment_id" required><br> -->
    Student ID: <input type="text" name="student_id" required class="form-control my-3 red-input"><br>
    batch ID: <input type="number" name="batch_id" required class="form-control my-3 red-input"><br>
    Upload Assignment: <input type="file" name="assignment_file" required class="form-control my-3 red-input"><br>
    <input type="submit" value="Submit Assignment" class="btn btn-danger">
</form>
