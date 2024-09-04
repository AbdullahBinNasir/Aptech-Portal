<?php

$server = 'localhost';
$username = 'root';
$password = "";
$DB_Name = "vision";

$connection = mysqli_connect($server, $username, $password, $DB_Name);

if ($connection) {

    echo "
    <script>
        console.log('Connected');
    </script>
    ";
} else {
    echo "
      
    <script>
    console.log('Connection Failed');
    </script>
";
}

?>