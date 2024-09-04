<?php

// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    $profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = ?";

    $stmt = $connection->prepare($profile);
    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $get_Pic = $stmt->get_result();

    if ($get_Pic->num_rows > 0) {
        while ($data = $get_Pic->fetch_assoc()) {

            // Handle form submission
            if (isset($_POST['signup123'])) {

                $name = $_POST['name'];
                $description = $_POST['description'];
                $eventDate = $_POST['event-date'];
                $location = $_POST['location'];
                $Organizer_id = $_POST['organizer_id'];
                $deadline = $_POST['deadline'];
                $attendance = $_POST['attendence'];

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if ($_FILES['image']['error'] == 4) {
                        echo "<script>alert('Image not found')</script>";
                    } else {
                        $imgname = $_FILES['image']['name'];
                        $tmpname = $_FILES['image']['tmp_name'];
                        $size = $_FILES['image']['size'];
                        $validExtensions = ["png", "jpg", "jpeg"];
                        $extension = strtolower(pathinfo($imgname, PATHINFO_EXTENSION));

                        if ($size > 1000000) {
                            echo "<script>alert('File too large')</script>";
                        } elseif (!in_array($extension, $validExtensions)) {
                            echo "<script>alert('File type not supported')</script>";
                        } else {
                            $newimgname = uniqid() . "." . $extension;

                            $insert = "INSERT INTO events (event_name, description, event_date, location, organizer_id, registration_deadline, max_attendees, image) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = $connection->prepare($insert);
                            $stmt->bind_param('ssssssis', $name, $description, $eventDate, $location, $Organizer_id, $deadline, $attendance, $newimgname);

                            if ($stmt->execute()) {
                                move_uploaded_file($tmpname, "images/" . $newimgname);
                                echo "<script>alert('Event details added successfully.')</script>";
                            } else {
                                echo "<script>alert('Failed to insert data.')</script>";
                            }
                        }
                    }
                } else {
                    echo "<script>alert('Failed to register your account.')</script>";
                }
            }

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
                <!-- top-navbar Ends Here -->

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
                                <div class="container my-4">
                                    <h1 class="text-center">Events</h1>
                                    <form action="" method="post" enctype="multipart/form-data" class="form-group">
                                        <div class="form-group">
                                            <label class="mt-3" for="name">Enter Event Name:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                   placeholder="Enter Event Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="mt-3" for="description">Enter Event Description:</label>
                                            <input type="text" name="description" id="description" class="form-control"
                                                   placeholder="Enter Event Description">
                                        </div>
                                        <div class="form-group">
                                            <label class="mt-3" for="date">Enter Event Date:</label>
                                            <input type="date" name="event-date" id="date" class="form-control"
                                                   placeholder="Enter Event Date">
                                        </div>
                                        <div class="form-group">
                                            <label class="mt-3" for="location">Location:</label>
                                            <input type="text" name="location" id="location" class="form-control"
                                                   placeholder="Enter Event Location">
                                        </div>

                                        <label class="mt-3" for="Organizer">Organizer:</label>
                                        <select name="organizer_id" id="Organizer" class="form-control">
                                            <?php
                                            $getorganizer = "SELECT * FROM users WHERE role='Admin' OR role='HR'";
                                            $getorganizer_run = $connection->query($getorganizer);

                                            if ($getorganizer_run->num_rows > 0) {
                                                while ($organizer = $getorganizer_run->fetch_assoc()) {
                                                    echo '<option value="' . $organizer['user_id'] . '">' . $organizer['full_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                        <div class="form-group">
                                            <label class="mt-4" for="deadline">Registration Deadline:</label>
                                            <input type="date" name="deadline" id="deadline" class="form-control"
                                                   placeholder="Registration Deadline">
                                        </div>
                                        <div class="form-group">
                                            <label class="mt-3" for="attendence">Maximum Attendance:</label>
                                            <input type="number" name="attendence" id="attendence" class="form-control"
                                                   placeholder="Max Attendees">
                                        </div>
                                        <input class="form-control my-3" type="file" name="image" id="image"
                                               accept=".jpg, .png, .jpeg">
                                        <input type="submit" name="signup123" class="form-control btn btn-primary my-2 text-light"
                                               style='background-color:#0b132b;'>
                                    </form>
                                </div>
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
