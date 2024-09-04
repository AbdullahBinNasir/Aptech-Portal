<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

	// $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
	// $profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = '" . $_SESSION['email'] . " ';";
    $profile = "SELECT u.*, e.* FROM users u INNER JOIN employees e ON u.email = e.email WHERE u.email = '" . $_SESSION['email'] . " ';";
	$get_Pic = mysqli_query($connection, $profile);


	if (mysqli_num_rows($get_Pic) > 0) {
		while ($data = mysqli_fetch_assoc($get_Pic)) {
?>


			<body>

				<!-- Pre-loader  Starts-->
				<?php
				// include "./Components/Preloader.php";
				?>
				<!-- Pre-loader  Ends-->


				<!-- top-navbar Starts Here -->
				<?php
				include "./Components/navbar.php";
				?>

				<!-- Right Sidebar starts Here...! -->
				<?php
				include "./Components/rightSidebar.php";
				?>
				<!-- Right Sidebar Ends Here...! -->

				<!-- Left Sidebar starts Here...! -->
				<?php
				include "./Components/leftSidebar.php";
				?>
				<!-- Left Sidebar Ends Here...! -->


				<div class="mobile-menu-overlay"></div>

				<div class="main-container">
					<div class="pd-ltr-20 xs-pd-20-10">


						<div class="min-height-200px">



							<div class="page-header">
<?php
require "../Connection/connection.php"; // Adjust the path as needed

// Include Bootstrap CSS
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $batch_id = $_POST['batch_id'];
    $request_date = $_POST['request_date'];

    // Validate if book_id and batch_id exist in their respective tables
    $book_check = $connection->prepare("SELECT id FROM books WHERE id = ?");
    $book_check->bind_param("i", $book_id);
    $book_check->execute();
    $book_check->store_result();

    $batch_check = $connection->prepare("SELECT batch_id FROM batches WHERE batch_id = ?");
    $batch_check->bind_param("i", $batch_id);
    $batch_check->execute();
    $batch_check->store_result();

    if ($book_check->num_rows > 0 && $batch_check->num_rows > 0) {
        // Prepare and execute SQL query to insert request
        $sql = "INSERT INTO requests (book_id, batch_id, request_date) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iis", $book_id, $batch_id, $request_date);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Request submitted successfully.</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Invalid book or batch selected.</div>';
    }
}

// Fetch books and batches for the dropdowns
$books_result = $connection->query("SELECT id, title FROM books");
$batches_result = $connection->query("SELECT batch_id, batch_name FROM batches");

// Start HTML structure
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Book Request Form</title>';
echo '</head>';
echo '<body>';

// Form for requesting a book
echo '<div class="container mt-5">';
echo '<h2>Book Request Form</h2>';
echo '<form method="post" action="">';

// Book selection
echo '<div class="form-group">';
echo '<label for="book_id">Select Book:</label>';
echo '<select id="book_id" name="book_id" class="form-control" required>';
while ($book = $books_result->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($book['id']) . '">' . htmlspecialchars($book['title']) . '</option>';
}
echo '</select>';
echo '</div>';

// Batch selection
echo '<div class="form-group">';
echo '<label for="batch_id">Select Batch:</label>';
echo '<select id="batch_id" name="batch_id" class="form-control" required>';
while ($batch = $batches_result->fetch_assoc()) {
    echo '<option value="' . htmlspecialchars($batch['batch_id']) . '">' . htmlspecialchars($batch['batch_name']) . '</option>';
}
echo '</select>';
echo '</div>';

// Date selection
// Date selection
echo '<div class="form-group">';
echo '<label for="request_date">Request Date:</label>';
echo '<input type="date" id="request_date" name="request_date" class="form-control" required min="' . date('Y-m-d') . '">';
echo '</div>';


// Submit button
echo '<button type="submit" class="btn btn-primary">Submit Request</button>';
echo '</form>';
echo '</div>';

// Close HTML tags
echo '</body>';
echo '</html>';

$connection->close();
?>
</div>
						
						
						
						
						
						</div>

						<!-- Footer Starts Here -->
						<?php
						include "./Components/footer.php";
						?>
						<!-- Footer Ends Here -->
					</div>
				</div>
				<!-- js -->
				<script src="vendors/scripts/core.js"></script>
				<script src="vendors/scripts/script.min.js"></script>
				<script src="vendors/scripts/process.js"></script>
				<script src="vendors/scripts/layout-settings.js"></script>
			</body>

			</html>

<?php

		}
	}
}

?>

