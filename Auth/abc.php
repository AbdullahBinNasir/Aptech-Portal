

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
</head>
<body>
    <form action="Sign.php" method="post">
        <h2>User Information</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"><br>

        <h2>Student Information</h2>
        <label for="program">Program:</label>
        <input type="text" id="program" name="program"><br>

        <label for="batch_id">Batch ID:</label>
        <input type="text" id="batch_id" name="batch_id" required><br>

        <label for="current_courses">Current Courses:</label>
        <input type="text" id="current_courses" name="current_courses"><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
