<?php
session_start();
require "../Connection/connection.php";

// Assuming the student is logged in and their ID is stored in the session
$student_id = 28; // Adjust based on your session management

// Fetch the student's group(s)
$queryGroups = "
    SELECT gm.group_id 
    FROM group_members gm 
    WHERE gm.student_id = '$student_id'
";

$resultGroups = mysqli_query($connection, $queryGroups);
$group_ids = [];

if ($resultGroups) {
    while ($group = mysqli_fetch_assoc($resultGroups)) {
        $group_ids[] = $group['group_id'];
    }
} else {
    echo "Error fetching groups: " . mysqli_error($connection);
    exit;
}

// Check if any group IDs were found
if (!empty($group_ids)) {
    // Convert group IDs to a comma-separated string for the SQL query
    $group_ids_str = implode(',', $group_ids);

    // Fetch projects that haven't been submitted yet by the student's group(s)
    $queryPendingProjects = "
        SELECT p.project_id, p.title, p.due_date
        FROM projects p
        
        LEFT JOIN e_submissions es ON p.project_id = es.project_id
        WHERE es.submission_id IS NULL
        ORDER BY p.due_date ASC
    ";

    $resultPendingProjects = mysqli_query($connection, $queryPendingProjects);

    if (!$resultPendingProjects) {
        echo "Error fetching pending projects: " . mysqli_error($connection);
        exit;
    }
} else {
    $resultPendingProjects = false; // No groups found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Projects</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file here -->
</head>
<body>
    <h2>Pending Projects</h2>

    <?php if ($resultPendingProjects && mysqli_num_rows($resultPendingProjects) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Project Title</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($project = mysqli_fetch_assoc($resultPendingProjects)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['project_id']); ?></td>
                        <td><?php echo htmlspecialchars($project['title']); ?></td>
                        <td><?php echo htmlspecialchars($project['due_date']); ?></td>
                       <td><?php echo '<a href="teamleader_submit_project.php?id='.$project["project_id"].'" class="btn btn-success px-2 mx-2">Submit</a>' ?>
    </td>'
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif ($resultPendingProjects === false): ?>
        <p>No groups found for this student.</p>
    <?php else: ?>
        <p>No pending projects found.</p>
    <?php endif; ?>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
