<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // Fetch data from `e_project_assignments` table, excluding rows where is_Assigned is 0
    $query = "
        SELECT 
            epa.Group_Id,
            b.batch_name,
            u.full_name
        FROM 
            e_project_assignments epa
        LEFT JOIN 
            batches b ON epa.batch_id = b.batch_id
        LEFT JOIN 
            users u ON epa.student_id = u.user_id
        WHERE 
            epa.is_Assigned != 0
    ";

    $result = $connection->query($query);
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
                                    <!DOCTYPE html>
                                    <html lang="en">

                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>Project Assignments</title>
                                        <style>
                                            table {
                                                border-collapse: collapse;
                                                width: 100%;
                                            }

                                            th,
                                            td {
                                                border: 1px solid black;
                                                padding: 8px;
                                                text-align: left;
                                            }

                                            th {
                                                background-color: #f2f2f2;
                                            }

                                            .container {
                                                padding: 20px;
                                            }

                                            .btn {
                                                padding: 10px 15px;
                                                /* background-color: #007bff; */
                                                color: #fff;
                                                border: none;
                                                border-radius: 5px;
                                                text-decoration: none;
                                                display: inline-block;
                                            }

                                            .btn:hover {
                                                background-color: #0056b3;
                                            }
                                        </style>
                                    </head>

                                    <body>
                                        <div class="container">
                                            <h1>Project Assignments</h1>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Group ID</th>
                                                        <th>Batch Name</th>
                                                        <th>Student Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>
                                    <td>{$row['Group_Id']}</td>
                                    <td>{$row['batch_name']}</td>
                                    <td>{$row['full_name']}</td>
                                    <td><a href='Assign_E-Project.php?group_id={$row['Group_Id']}' class='btn btn-danger'>Assign Projects</a></td>
                                  </tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='4'>No data found</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </body>

                                    </html>

                                    <?php
                                    // Close the connection
                                    $connection->close();
            }
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