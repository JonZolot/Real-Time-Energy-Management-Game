
<?php
//Page to set up registration
session_start();
$_SESSION["username"] = $_GET[username] ;

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

$q = $_GET[username];
//take in username and two passwords

$pwd = $_GET[password1];
$pwd2 = $_GET[password2];
$field1 = $_GET[question1];
$field2 = $_GET[question2];
$field3 = $_GET[question3];
$sql = "SELECT username FROM user_data WHERE username = '$q'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query failed to execute for some reason');
}

if (mysqli_num_rows($result) > 0) {
	die('User id exists already.');

}

if (strcmp($pwd, $pwd2) !== 0) {
	die('Passwords entered do not match');

} 

if($q === ""){//kills if there isn't a username
	die('Please Enter a Username');		
}
if($pwd === ""){//kills if there's no password
	die('Please Enter a Pasword');		
}

else {//creates an entry into the database
	$sql = "INSERT INTO user_data (username, password, happiness) VALUES ('$q', '$pwd', '100')";
	mysqli_query($conn, $sql);
	$sql = "INSERT INTO survey (username, people, rooms, sq_ft) VALUES ('$q', '$field1', '$field2', '$field3')";
	mysqli_query($conn, $sql);
	echo 1; 

}



mysqli_close($conn);
?>



