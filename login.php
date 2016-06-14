
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

$user = $_GET["username"];
$pwd = $_GET["password"];

//checks username and passowrd given
$sql = "SELECT username, password FROM user_data WHERE username = '$user'";

$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$tmp = $row['password'];

if (mysqli_num_rows($result) == 0) {
	die('Username Does Not Match');
}

if ($pwd !== $tmp) { 
	die('Password Does Not Match');
}

//starts a session and sets the username and password session variables
session_start();
$_SESSION["username"] = $_GET["username"];
$_SESSION["password"] = $_GET["password"];

mysqli_close($conn);
echo 1;
?>

