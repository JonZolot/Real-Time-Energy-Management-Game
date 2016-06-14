<?php
session_start();
$user = $_SESSION["username"];
$servername = "localhost";
$username = "wcp38";
$password = "b4DceWdE9u";
$dbname = "wcp38";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//takes in appliance, and time, then creates an entry in the table based on the type of appliance and time constraints
$q = $_GET["q"];
$p = $_GET["p"];


if ($p == 0){
$sql = "INSERT INTO $q (id, username, start, stop, time_diff, time_left, status)
VALUES (NULL, '$user', NOW(), '', '$p', '$p', '1')";
	
} else{
$sql = "INSERT INTO $q (id, username, start, stop, time_diff, time_left, status)
VALUES (NULL, '$user', NOW(), NOW(), '$p', '$p', '1')";
}

if (mysqli_query($conn, $sql)) {
//    echo time();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>

