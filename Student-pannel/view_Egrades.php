<?php
session_start();
require "../Connection/connection.php";

// Fetch all groups for the group selection dropdown
$queryGroups = "SELECT group_id, group_name FROM groups";
$resultGroups = mysqli_query($connection, $queryGroups);

if (!$resultGroups) {
    echo "Error fetching groups: " . mysqli_error($connection);
    exit;
}

// Initialize variables
$projectsOptions = '';
$gradesTable = '';
$group_id = '';
$project_id = '';

if (isset($_POST['group_id'])) {
    $group_id = mysqli_real_escape_string($connection, $_POST['group_id']);

    // Fetch projects assigned to the selected group
    $queryProjects = "
        SELECT p.project_id, p.title
        FROM projects p
        INNER JOIN e_submissions es ON p.project_id = es.project_id
        WHERE es.group_id = '$group_id'
    ";
    $resultProjects = mysqli_query($connection, $queryProjects);

    if (!$resultProjects) {
        echo "Error fetching projects: " . mysqli_error($connection);
        exit;
    }

    while ($project = mysqli_fetch_assoc($resultProjects)) {
        $projectsOptions .= "<option value='{$project['project_id']}'>{$project['title']}</option>";
    }
}

if (isset($_POST['project_id'])) {
    $project_id = mysqli_real_escape_string($connection, $_POST['project_id']);

    // Fetch grades for the selected project and group
    $queryGrades = "
        SELECT g.grade, g.comments, g.group_id, g.project_id
        FROM grades g
        WHERE g.group_id = '$group_id' AND g.project_id = '$project_id'
    ";
    $resultGrades = mysqli_query($connection, $queryGrades);

    if (!$resultGrades) {
        echo "Error fetching grades: " . mysqli_error($connection);
        exit;
    }

    if (mysqli_num_rows($resultGrades) > 0) {
        $gradesTable .= "<table border='1'>
                            <tr>
                                <th>Group ID</th>
                                <th>Project ID</th>
                                <th>Grade</th>
                                <th>Comments</th>
                            </tr>";

        while ($grade = mysqli_fetch_assoc($resultGrades)) {
            $gradesTable .= "<tr>
                                <td>{$grade['group_id']}</td>
                                <td>{$grade['project_id']}</td>
                                <td>{$grade['grade']}</td>
                                <td>{$grade['comments']}</td>
                            </tr>";
        }
        
        $gradesTable .= "</table>";
    } else {
        $gradesTable = "No grades found for the selected project and group.";
    }
}
?>

<form method="POST" action="">
    <label for="group_id">Select Group:</label>
    <select name="group_id" id="group_id" onchange="this.form.submit()" required>
        <option value="">Select a group</option>
        <?php
        // Output all groups as options
        while ($group = mysqli_fetch_assoc($resultGroups)) {
            $selected = ($group_id == $group['group_id']) ? 'selected' : '';
            echo "<option value='{$group['group_id']}' $selected>{$group['group_name']}</option>";
        }
        ?>
    </select>

    <?php if ($group_id): ?>
        <label for="project_id">Select Project:</label>
        <select name="project_id" id="project_id" onchange="this.form.submit()" required>
            <?php echo $projectsOptions; ?>
        </select>
    <?php endif; ?>
</form>

<?php echo $gradesTable; ?>

<?php
// Close the database connection
mysqli_close($connection);
?>
