<?php
session_start();
require "../Connection/connection.php";

// Assuming the student is logged in and their ID is stored in the session
$student_id = $_SESSION['student_id']; // Adjust based on your session management

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

// Convert group IDs to a comma-separated string for the SQL query
$group_ids_str = implode(',', $group_ids);

// Fetch projects that haven't been submitted yet by the student's group(s)
$queryPendingProjects = "
    SELECT p.project_id, p.project_title, p.due_date
    FROM e_projects p
    INNER JOIN group_projects gp ON p.project_id = gp.project_id
    LEFT JOIN e_submissions es ON p.project_id = es.project_id AND gp.group_id = es.group_id
    WHERE gp.group_id IN ($group_ids_str) AND es.submission_id IS NULL
    ORDER BY p.due_date ASC
";

$resultPendingProjects = mysqli_query($connection, $queryPendingProjects);

if (!$resultPendingProjects) {
    echo "Error fetching pending projects: " . mysqli_error($connection);
    exit;
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

    <?php if (mysqli_num_rows($resultPendingProjects) > 0): ?>
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
                        <td><?php echo htmlspecialchars($project['project_title']); ?></td>
                        <td><?php echo htmlspecialchars($project['due_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pending projects found.</p>
    <?php endif; ?>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
