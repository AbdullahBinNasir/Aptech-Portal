<?php
// include ("../Connection/header.php");
require ("../Connection/connection.php");
if (isset($_POST['signin']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $check = "SELECT * FROM users WHERE email='$email';";
    $result = mysqli_query($connection, $check) or die("failed to insert query.");
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $regUsername = $row['username'];
            $regEmail = $row['email'];
            $regPass = $row['password'];//hash
            $verifyPass = password_verify($password, $regPass);

            $role = "SELECT * FROM users  ";
            $res = mysqli_query($connection, $role) or die("failed to insert query");


            if ($verifyPass) {
                session_start();
                $_SESSION['email'] = $regEmail;
                $_SESSION['username'] = $regUsername;
                if ($res) {
                    if (mysqli_num_rows($res) > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            if ($row['role'] == 'Employee') {
                                echo "<script>alert('Successfully logged in.')
                                window.location.href='employee.html' ;</script>";
                            } elseif ($row['role'] == 'Student') {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='student.html' ;</script>";
                            } elseif ($row['role'] == 'HR') {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='HR.html' ;</script>";
                            } elseif ($row['role'] == 'Admin') {
                                echo "<script>alert('Successfully logged in.') 
                                window.location.href='../Admin-pannel/adminDashboard.php';</script>";
                            }
                        }
                    }

                }

            } else {
                echo "<script>alert('Invalid Credentials.')</script>;";
            }
        } else {
            echo "<script>alert('Pehle account bana kr aao.')
       window.location.href='signup.php';</script>;";
        }
    }
}


?>

<body>
    <div class="container my-4">
        <h1 class="text-center">Log In</h1>
        <form action="" method="post" class="form-group">
            <input type="email" name="email" id="" class="form-control my-2" placeholder="Enter email">
            <input type="password" name="password" id="" class="form-control my-2" placeholder="Enter Your password">
            <a href="forgetpass.php">Forget your password?</a>
            <input type="submit" name="signin" id="" class="form-control btn btn-dark my-2">
        </form>
    </div>
</body>

</html>