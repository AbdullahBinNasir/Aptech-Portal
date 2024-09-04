<?php
require "../Connection/connection.php"; // Adjust the path as needed

// Include Bootstrap CSS
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    $sql = "UPDATE books SET title='$title', author='$author', year='$year' WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $connection->error . "</div>";
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM books WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

?>

<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // $profile = "SELECT * from `users`where `email` = '" . $_SESSION['email'] . " ';";
    $profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = '" . $_SESSION['email'] . " ';";

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

                                echo '<div class="container mt-5">';
                                echo '<h2>Edit Book</h2>';
                                echo '<form method="post" action="">';
                                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                                echo '<div class="form-group">';
                                echo '<label for="title">Title:</label>';
                                echo '<input type="text" class="form-control" id="title" name="title" value="' . $row['title'] . '" required>';
                                echo '</div>';
                                echo '<div class="form-group">';
                                echo '<label for="author">Author:</label>';
                                echo '<input type="text" class="form-control" id="author" name="author" value="' . $row['author'] . '" required>';
                                echo '</div>';
                                echo '<div class="form-group">';
                                echo '<label for="year">Year:</label>';
                                echo '<input type="text" class="form-control" id="year" name="year" value="' . $row['year'] . '" required>';
                                echo '</div>';
                                echo '<button type="submit" class="btn btn-primary">Update</button>';
                                echo '<a href="display_books.php" class="btn btn-secondary">Cancel</a>';
                                echo '</form>';
                                echo '</div>';

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