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


$q = $_GET["q"];
//default all apliances  to off and storing both times

$sql = "INSERT INTO $q (id, username, start, stop, time_diff, time_left, status)
VALUES (NULL, '$user', NOW(), NOW(), '', '0', '0')";


if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>

