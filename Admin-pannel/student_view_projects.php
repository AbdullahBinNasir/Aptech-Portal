<?php
session_start();
require "../Connection/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $group_id = mysqli_real_escape_string($connection, $_POST['group_id']);

    // Fetch projects assigned to the group (assuming projects table has a group_id column)
    $queryProjects = "
        SELECT p.project_id, p.title,p.description, p.due_date
        FROM projects p
        WHERE p.group_id = '$group_id'
    ";

    $resultProjects = mysqli_query($connection, $queryProjects);

    if (!$resultProjects) {
        echo "Error fetching projects: " . mysqli_error($connection);
        exit;
    }
} else {
    echo "Invalid request method.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Projects</title>
</head>
<body>
    <h2>Assigned Projects</h2>

    <?php if (mysqli_num_rows($resultProjects) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Project Title</th>
                    <th>Project Description</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($project = mysqli_fetch_assoc($resultProjects)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                        <td><?php echo htmlspecialchars($project['description']); ?></td>
                        <td><?php echo htmlspecialchars($project['due_date']); ?></td>
                        <td><?php echo '<a href="teamleader_submit_project.php?id='.$group_id.'" class="btn btn-success px-2 mx-2">Submit</a>' ?></td>
                        <td><?php echo $group_id ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No projects assigned to this group.</p>
    <?php endif; ?>
</body>
</html>

<?php
mysqli_close($connection);
?>
