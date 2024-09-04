<?php
require ('../Connection/connection.php');

$sql = "SELECT s.*, u.* FROM students s INNER JOIN users u ON s.email = u.email ;";
$result = $connection->query($sql);


$users = [];
	
if ($result->num_rows > 0) {

    while ($rows = $result->fetch_assoc()) {
        $users[] = $rows;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Table</title>
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Link to your CSS -->


		<!-- Basic Page Info -->
		<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>

</head>
<body>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Students Table</h4>
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <!-- <th>Start Date</th> -->
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>

				<?php

foreach ($users as $user) {
    if ($user['role'] == 'Student'): ?>
        <tr>
            <td class="table-plus"><?php echo htmlspecialchars($user['full_name']); ?></td>
            <td class="table-plus"><?php echo htmlspecialchars($user['email']); ?></td>
            <td class="table-plus"><?php echo htmlspecialchars($user['address']); ?></td>
            <td class="table-plus"><?php echo htmlspecialchars($user['phone_number']); ?></td>
            <td>
                <a href="" class="btn btn-success btn-rounded">View Profile</a>
                <a href="student-remove.php?id=<?php echo $user['student_id']; ?>" class="btn btn-danger btn-rounded">Remove</a>
            </td>
        </tr>
    <?php 
    endif; 
}
?>

						
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
