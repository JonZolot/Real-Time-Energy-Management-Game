<?php
$servername = "localhost";
$username = "wcp38";
$password = "b4DceWdE9u";
$dbname = "wcp38";

session_start();
$user = $_SESSION["username"];
$q = $_GET["q"];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//stores the new total power back into the user's account
		$sql = "update user_data 
		SET total_power = $q
		WHERE username = '$user'";
		mysqli_query($conn, $sql);
		

				
mysqli_close($conn);

?>