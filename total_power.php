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

session_start();
$q = $_GET["q"];
$user = $_SESSION["username"];


//Looks at status, if the status is on, then the output will be the power, or else the output will be 0
$sql = "SELECT status 
FROM $q 
WHERE username = '$user'
ORDER BY id DESC
LIMIT 1";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_assoc($result);
mysqli_free_result($result);


//for each appliance, output the power
if ($row['status'] > 0){
	$sql = "SELECT kwh 
	FROM appliance_power_constants
	WHERE appliance = '$q' ";
	$result = mysqli_query($conn, $sql);

	$row=mysqli_fetch_assoc($result);
	
	mysqli_free_result($result);
echo $row['kwh'];
} else{
	echo 0;
}
mysqli_close($conn);
?>

