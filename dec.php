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

date_default_timezone_set('America/New_York');
//table filled with every database table
$tables = array("Coffee_Maker",
				"Computer",
				"Dish_Washer", 
				"Dryer",
				"Fridge",
				"Lights",
				"Microwave",
				"Stove",
				"Television",
				"Toaster", 
				"Washer",
				"Water_Heater");


$sql = "SELECT username 
FROM user_data";
$result = mysqli_query($conn, $sql);


//for each username in the database, check each appliance and decrement the time on each one.
//additionally decrement every happiness by one. All done to show a minute has passed
if (mysqli_num_rows($result)) {
		// output data of each row
		while($row = mysqli_fetch_array($result)) {//
				$tmp = $row['username'];
				$sql = "SELECT happiness, money 
				FROM user_data
				WHERE username = '$tmp'";
				$result3 = mysqli_query($conn, $sql);
				$row=mysqli_fetch_assoc($result3);

				$start_hap =  $row['happiness']; //save happines
				$start_money =  $row['money']; //save money
				$total_power = 0; //set power variable

				for ($i = 0; $i < sizeof($tables); $i++) {
					$sql = "SELECT status 
						FROM $tables[$i]
						WHERE username = '$tmp'
						ORDER BY id DESC
						LIMIT 1";
					
					$result2 = mysqli_query($conn, $sql);
					$row=mysqli_fetch_assoc($result2);
					//look at the happiness for each appliance as well as its power
					if ($row['status'] == 1){ 
					$sql = "SELECT happiness, kwh 
						FROM appliance_power_constants
						WHERE appliance = '$tables[$i]'";
					
					$result4 = mysqli_query($conn, $sql);
					$row=mysqli_fetch_assoc($result4);
					$start_hap = $start_hap + $row['happiness'] - 1; //decrement the happiness as well ass adding the happines for each appliance
					$total_power = $total_power + $row['kwh'];//add the powers together
					//echo $start_hap . " ";
					}
					
					//echo $tmp;
				
				}
				//take in the total power and happines and store the new values
			date_default_timezone_set("America/New_York");
			$hour = date(G);
		$multi = 0;
				if ($hour == 1){
					$multi == .08;
				} elseif ($hour == 2){
					$multi == .1;
				
				}  elseif ($hour == 3){
					$multi ==.14;
				
				} elseif ($hour == 4){
					$multi = .17;
				
				} elseif ($hour == 5){
					$multi = .2;
				
				} elseif ($hour ==6){
					$multi = .21;
				
				} elseif ($hour == 7){
					$multi = .20;
				
				} elseif ($hour == 8){
					$multi = .17;
				
				} elseif ($hour == 9){
					$multi = .14;
				
				} elseif ($hour == 10){
					$multi = .1;
					
				} elseif ($hour == 11){
					$multi = .08;
				
				} elseif ($hour == 12){
					$multi = .07;
				
				} elseif ($hour == 13){
					$multi = .08;
				
				} elseif ($hour == 14){
					$multi = .07;
				
				} elseif ($hour == 15){
					$multi = .14;
				} elseif ($hour == 16){
					$multi = .17;
				} elseif ($hour == 17){
					$multi = .2;
				} elseif ($hour == 18){
					$multi = .21;
				} elseif ($hour == 19){
					$multi = .2;
				}elseif ($hour == 20){
					$multi = .17;
				
				} elseif ($hour == 21){
					$multi = .14;
				}elseif ($hour == 22){
					$multi = .1;
				}elseif ($hour == 23){
					$multi = .08;
				}else{
					$multi = .07;
				} 

			$spent = $multi * $total_power;
			$start_money = $start_money - $spent;

			$sql = "UPDATE user_data 
			SET happiness = $start_hap, total_power = $total_power, money = $start_money 
			WHERE username='$tmp'";
			mysqli_query($conn, $sql);	

			}
		}

for ($i = 0; $i < sizeof($tables); $i++) { //decrement time for each appliance that is on, if time reaches 0, turn off appliance
	if(($tables[$i] != "Computer") and ($tables[$i]  != "Television")){
	$sql = "SELECT id, time_left, status FROM $tables[$i]";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		    if ($row["status"] == 1) {
		    	$tmp = $row["time_left"] - 1;
		    	$t = $row["id"];
		   		$sql = "UPDATE $tables[$i] SET time_left = $tmp WHERE id = '$t'";
		   		mysqli_query($conn, $sql);

		   		if ($tmp == 0){
		   			$sql = "UPDATE $tables[$i] SET status = 0 WHERE id = '$t'";
		   			mysqli_query($conn, $sql);
	$result = mysqli_query($conn, $sql);

		   		}	
		   	}
		}
	}
	}
}




mysqli_close($conn);
?>
