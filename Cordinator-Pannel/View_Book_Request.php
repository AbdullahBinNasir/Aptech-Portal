<?php

require "../Connection/connection.php";


    $sql = "SELECT requests.*, batches.batch_name, books.title, 
        (SELECT COUNT(*) FROM students WHERE students.batch_id = requests.batch_id) AS student_count
        FROM requests 
        LEFT JOIN batches ON requests.batch_id = batches.batch_id 
        LEFT JOIN books ON requests.book_id = books.id
        WHERE requests.is_Assigned != 0";

$result = $connection->query($sql);

// Check if the query was successful
if ($result === false) {
    // Output the SQL error message
    echo "Error: " . $connection->error;
} else {
    // Proceed with the rest of your code
    ?>
    
    <!-- Your existing HTML and PHP code goes here -->

    <?php
}
$connection->close();


// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
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
                                <!DOCTYPE html>
                                <html lang="en">

                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Requests Table</title>
                                    <!-- Bootstrap CSS -->
                                    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
                                        rel="stylesheet">
                                </head>

                                <body>
                                    <div class="container mt-4">
                                        <h2 class="mb-4">Book Requests</h2>

                                        <?php if ($result->num_rows > 0): ?>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <!-- <th>Request ID</th> -->
                                                        <th>Batch Name</th>
                                                        <th>Book Name</th>
                                                        <th>Number of Students</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $result->fetch_assoc()): ?>
                                                        <tr>
                                                            <!-- <td><?php echo $row['id']; ?></td> -->
                                                            <td><?php echo $row['batch_name']; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['student_count']; ?></td>
                                                            <td>
                                                                <form method="POST" action="approve_request.php" class="d-inline">
                                                                    <input type="hidden" name="request_id"
                                                                        value="<?php echo $row['id']; ?>">
                                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                            <p class="alert alert-info">No results found.</p>
                                        <?php endif; ?>

                                    </div>

                                    <!-- Bootstrap JS and dependencies -->
                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                    <script
                                        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                </body>

                                </html>

                                <?php
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