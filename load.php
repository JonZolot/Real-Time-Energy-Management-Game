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

//get appliance from client and use session username
$q = $_GET["q"];
$user = $_SESSION["username"];



//checks the appliance's last entry based on the session username
$sql = "SELECT status 
FROM $q 
WHERE username = '$user'
ORDER BY id DESC
LIMIT 1";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_assoc($result);
mysqli_free_result($result);

//if the appliance is on, its status is 1
if ($row['status'] > 0){
	echo 1;
} else{
//	echo "On";
	echo 0;
}
mysqli_close($conn);
?>

