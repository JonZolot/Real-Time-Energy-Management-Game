<?php

session_start();
$tmp = "admin";
if ($_SESSION['username'] == $tmp) {

}
else {
	echo "Access Denied";
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "getPower.php",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      var options = {
          title: 'Simulink House Data',
          hAxis: { title: 'Time (Minutes)'},
          vAxis: { title: 'Power (Units)'}
        };


      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      chart.draw(data, options);
    }

    </script>
  
<style>
  .custom {
    width: 200px !important;   
}

.top-buffer { 
	margin-top: 8px; 
}
</style>
</head>
<body>

<div class="container-fluid">
  <h1>Admin Settings</h1>
</div>

<div class="top-buffer"></div>

<div class="container-fluid">
	<a href="constants.php" class="btn btn-primary custom" role="button">Adjust Appliance Constants</a>
	<a href="getusers.php" class="btn btn-primary custom" role="button">View User Data</a>
	<a href="simulink.php" class="btn btn-primary custom" role="button">Select Simulink Users</a>
	<a href="gameplaymessage.php" class="btn btn-primary custom" role="button">Send Gameplay Message</a>
	<a href="index.html" class="btn btn-primary custom" role="button">Return To Login Page</a>
</div>

    <!--Div that will hold the pie chart-->
    <div class="container-fluid">
    <div id="curve_chart" style="width: 1200px; height: 400px"></div>
	</div>
	
</body>
</html>
