<?php
$servername = "localhost";
$username = "wcp38";
$password = "b4DceWdE9u";
$dbname = "wcp38";

session_start();
$user = $_SESSION["username"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//checks the user's current amount of money and outputs the value
$sql = "SELECT money 
						FROM user_data
						WHERE username = '$user'";
					
					$result = mysqli_query($conn, $sql);
					$row=mysqli_fetch_assoc($result);
					echo $row['money'];
				
mysqli_close($conn);

?>