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

//looks for a message and if it is there, then displays it		
$sql = "SELECT message 
						FROM message
						WHERE username = '$user'
						ORDER BY id DESC
						LIMIT 1";
					
					$result2 = mysqli_query($conn, $sql);
					$row=mysqli_fetch_assoc($result2);
					echo $row['message'];
				
mysqli_close($conn);

?>