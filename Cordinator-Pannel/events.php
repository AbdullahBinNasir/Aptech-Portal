<?php
require '../Connection/connection.php';
include '../Connection/header.php';

if (isset($_POST['signup123'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $eventDate = $_POST['event-date'];
    $location = $_POST['location'];
    $Organizer_id = $_POST['organizer_id'];
    $deadline = $_POST['deadline'];
    $attendance = $_POST['attendence'];

    // echo $_POST['signup123'];


    $insert = "INSERT INTO `events`(`event_name`, `description`, `event_date`,`location`,`organizer_id`,`registration_deadline`,`max_attendees`) 
    values ('$name', '$description', '$eventDate','$location', '$Organizer_id','$deadline','$attendance');";

    $result = mysqli_query($connection, $insert) or die("Failed to insert query");

    if ($result) {

        echo "<script>alert('Student details added succesfully...')</script>";
    } else {

        echo "<script>alert('Failed to insert data.. ')</script>";
    }
}

?>

<body>

    <div class="container my-4">
        <h1 class="text-center">Events</h1>
        <form action="" method="post" class="form-group">
            <input type="text" name="name" id="" class="form-control my-2" placeholder="Enter Event Name">
            <input type="text" name="description" id="" class="form-control my-2" placeholder="Enter Event description">
            <input type="date" name="event-date" id="" class="form-control my-2" placeholder="Enter Event date">
            <input type="text" name="location" id="" class="form-control my-2" placeholder="Enter Event Location">
            <input type="text" name="organizer_id" id="" class="form-control my-2" value="28" placeholder="Enter organizer ID">
            <input type="date" name="deadline" id="" class="form-control my-2" placeholder="Registration Deadline">
            <input type="number" name="attendence" id="" class="form-control my-2" placeholder="Max Attendies">
            <!-- <input type="text" name="address" id="" class="form-control my-2" placeholder="Enter Your Address">
            <input type="number" nanume="phone" id="" placeholder="Enter Your Phone Number" class="form-control"> <br> <br>
            <input type="number" name="f-phone" id="" placeholder="Enter Your Guardian Phone Number" class="form-control"> <br> <br>
            <input type="number" name="CNIC" placeholder="CNIC/B-FORM" id="" class="form-control">
            <input class="form-control my-3" type="file" name="image" id="image" accept=".jpg, .png, .jpeg">
            <select name="program" id="">
                <option value="ADSE">ADSE</option>
                <option value="DISM">DISM</option>
                <option value="CPISM">CPISM</option>
            </select>
            <select name="courses" id="">
                <option value="FrontEnd-Dev">FrontEnd-Development</option>
                <option value="BackEnd-Dev">BackEnd-Development</option>
            </select> -->
            <input type="submit" name="signup123" id="" class="form-control btn btn-primary my-2">
        </form>
    </div>
</body>