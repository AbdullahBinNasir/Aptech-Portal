<?php
// header Starts here
require "../Connection/connection.php";
include "./Components/header.php";

session_start();
if (isset($_SESSION['username'])) {

    // Fetch user and admin details
    $profile = "SELECT u.*, a.* FROM users u INNER JOIN admins a ON u.email = a.user_email WHERE u.email = '" . $_SESSION['email'] . "';";
    $get_Pic = mysqli_query($connection, $profile);

    if (mysqli_num_rows($get_Pic) > 0) {
        while ($data = mysqli_fetch_assoc($get_Pic)) {
?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <!-- Add Bootstrap CSS -->
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
                <!-- Add your meta tags and other head elements here -->
                <script>
                    // Set the minimum date for the date input to today's date
                    document.addEventListener('DOMContentLoaded', function() {
                        var today = new Date().toISOString().split('T')[0];
                        document.getElementById('due_date').setAttribute('min', today);
                    });
                </script>
            </head>

            <body>

                <!-- Pre-loader Starts-->
                <?php
                // include "./Components/Preloader.php";
                ?>
                <!-- Pre-loader Ends-->

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

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">

                            <div class="page-header mb-4">
                                <h1 class="mt-5">E-Project Approval</h1>
                            </div>

                            <!-- Project Assignment Form Starts Here -->
                            <?php
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
                                    $target_dir = "uploads/";
                                    $target_file = $target_dir . $attachment;

                                    move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file);
                                }

                                // Insert project using prepared statements
                                $stmt = $connection->prepare("INSERT INTO projects (group_id, title, description, attachment, assigned_date, due_date) VALUES (?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("isssss", $group_id, $title, $description, $attachment, $assigned_date, $due_date);

                                if ($stmt->execute()) {
                                    echo "<div class='alert alert-success'>Project assigned successfully!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                                }
                            }
                            ?>

                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="group_id">Select Group:</label>
                                    <select name="group_id" id="group_id" class="form-control" required>
                                        <!-- Fetch and list groups from the database -->
                                        <?php
                                        $groupsQuery = "SELECT * FROM groups";
                                        $groupsResult = mysqli_query($connection, $groupsQuery);
                                        while ($group = mysqli_fetch_assoc($groupsResult)) {
                                            echo "<option value='" . $group['group_id'] . "'>" . $group['group_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Project Title:</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Project Description:</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="due_date">Due Date:</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="attachment">Attachment:</label>
                                    <input type="file" name="attachment" id="attachment" class="form-control-file">
                                </div>

                                <button type="submit" name="assign_project" class="btn btn-danger">Assign Project</button>
                            </form>
                            <!-- Project Assignment Form Ends Here -->

                        </div>
                    </div>
                </div>

                <!-- Footer Starts Here -->
                <?php
                include "./Components/footer.php";
                ?>
                <!-- Footer Ends Here -->

                <!-- js -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </body>

            </html>

<?php
        }
    }
}
?>
