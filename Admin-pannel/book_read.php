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



                            <div class="page-header"></div>

                            <?php
                            require "../Connection/connection.php"; // Adjust the path as needed
                            include "./Components/header.php"; // Include header
                
                            // Include Bootstrap CSS
                            echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';

                            // HTML and Bootstrap markup
                            echo '<body>';
                            echo '<div class="container mt-5">';
                            echo '<h2>Books List</h2>';
                            echo '<table class="table table-striped table-bordered">';
                            echo '<thead><tr><th>Title</th><th>Author</th><th>Year</th><th>Actions</th></tr></thead>';
                            echo '<tbody>';

                            $sql = "SELECT * FROM books";
                            $result = $connection->query($sql);



                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    // echo '<td>' . htmlspecialchars($row["id"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($row["title"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($row["author"]) . '</td>';
                                    echo '<td>' . htmlspecialchars($row["year"]) . '</td>';
                                    echo '<td>';
                                    echo '<a href="book_update.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-warning btn-sm">Edit</a> ';
                                    echo '<a href="book_delete.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-danger btn-sm">Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">No results found</td></tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                            echo '<a href="book_create.php" class="btn btn-primary">Add New Book</a>'; // Link to create new book
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