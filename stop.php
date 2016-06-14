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
//stops the current appliance
session_start();

$q = $_GET["q"];
$user = $_SESSION["username"];

//updates the appliance with the current time
$sql = "UPDATE $q
SET stop = NOW() 
WHERE username='$user'
ORDER BY id DESC 
LIMIT 1";

if (mysqli_query($conn, $sql)) {
//    echo time();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//takes in the start and stop times
$sql = "SELECT start, stop 
FROM $q 
WHERE username = '$user'
ORDER BY id DESC
LIMIT 1";
$result = mysqli_query($conn, $sql);

$row=mysqli_fetch_assoc($result);
mysqli_free_result($result);

$datetime1 = strtotime($row['stop']);
$datetime2 = strtotime($row['start']);

$datetime3 = $datetime1 - $datetime2;
$datetime3 = round(($datetime3 / 60));


//updates the time difference
$sql = "UPDATE $q
SET time_diff = $datetime3 
WHERE username='$user'
ORDER BY id DESC 
LIMIT 1";

if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//turns off the appliance
$sql = "UPDATE $q
SET status = '0' 
WHERE username='$user'
ORDER BY id DESC 
LIMIT 1";

if (mysqli_query($conn, $sql)) {

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>


