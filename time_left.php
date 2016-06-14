<?php
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
//checks how much time is left for a given appliance for a user or outputs a 0 if it is off
session_start();
$q = $_GET["q"];
$user = $_SESSION["username"];



//checks the status of the appliance
$sql = "SELECT status 
FROM $q 
WHERE username = '$user'
ORDER BY id DESC
LIMIT 1";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_assoc($result);
mysqli_free_result($result);

//if the appliance is on, searches for how  much time is left
if ($row['status'] > 0){
	$sql = "SELECT time_left 
	FROM $q 
	WHERE username = '$user'
	ORDER BY id DESC
	LIMIT 1";
	$result = mysqli_query($conn, $sql);

	$row=mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	echo $row['time_left'];
} else{

	echo 0;
}
mysqli_close($conn);
?>

