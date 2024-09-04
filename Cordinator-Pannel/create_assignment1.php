<?php
require "../Connection/connection.php";
include "./Components/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $batch_id = $_POST['batch_ID'];
    $faculty_id = $_POST['faculty_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO assignments (batch_id, faculty_id, title, description, due_date)
            VALUES ('$batch_id', '$faculty_id', '$title', '$description', '$due_date')";

    if ($connection->query($sql) === TRUE) {
        echo "New assignment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }


}
?>

<form method="POST" action="">
    <!-- Course ID: <input type="text" name="course_id" required><br> -->

    <div class="form-group">
        <select name="batch_ID" id="batch_ID" class="form-control my-3 red-input">
            <option value="" disabled selected>Select Batch</option>
            <?php
            $getbatch = "SELECT * from `batches` where assigned_faculty ";
            $getbatch_run = mysqli_query($connection, $getbatch) or die("failed to get categories");
            if (mysqli_num_rows($getbatch_run) > 0) {
                while ($batch = mysqli_fetch_assoc($getbatch_run)) {
                    echo '<option value="' . $batch['batch_id'] . '" >' . $batch['batch_name'] . '</option>';
                }
            }


            ?>
    </div><br>
    <label for="Faculty ID">Faculty ID:</label><input type="text" name="faculty_id" required class="form-control my-3 red-input"><br>
    Title: <input type="text" name="title" required class="form-control my-3 red-input"><br>
    Description: <textarea name="description" class="form-control my-3 red-input"></textarea><br>
    Due Date: <input type="date" name="due_date" required class="form-control my-3 red-input"><br>
    <input type="submit" value="Create Assignment" class="btn btn-danger">
</form>

<?php
    $connection->close();
?>