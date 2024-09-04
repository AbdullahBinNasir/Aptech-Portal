<?php
include "../Connection/connection.php";
require "../Connection/header.php";

if($_GET['id']){
    $id = $_GET['id'];

    $getdata = "SELECT * FROM `courses` WHERE Course_id='$id';";

    $result = mysqli_query($connection, $getdata) or die("fail to run query");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $name = $row['Course_Title'];
        $descripton = $row['Description'];
        $image = $row['image'];
        ?>
        <div class="container my-4">
            <h1 class="text-center">Enter Batch Details</h1>
            <form action="upCrsData.php" method="post" class="form-group">
                <input type="hidden" name="id" id="" class="form-control my-2" value="<?php echo $id ?>">
                <input type="text" name="course_name" id="" class="form-control my-2" placeholder="Enter Course name"
                    value="<?php echo $name ?>">
                <input type="text" name="Description" id="" class="form-control my-2" placeholder="Enter Description Date"
                value="<?php echo $descripton ?>">
                <input type="file" name="image" id="" class="form-control my-2" placeholder="Upload Image"
                    value="<?php echo $image ?>">
                <input type="submit" name="Add" id="" class="form-control btn btn-primary my-2">
            </form>
        </div>
        <?php
    }
} else {
    echo "id not found";
}
?>