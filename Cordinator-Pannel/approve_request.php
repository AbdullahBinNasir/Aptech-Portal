<?php 

require "../Connection/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];

    // SQL query to update the 'is_Assigned' column to zero
    $sql = "UPDATE requests SET is_Assigned = 0 WHERE id = ?";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("i", $request_id);

        if ($stmt->execute()) {
            echo "Request approved successfully.";
            header('location:View_Book_Request.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$connection->close();
?>
