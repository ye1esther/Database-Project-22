<head><title>Covid Overview</title></head>
<body>
<?php

	//open a connection to dbase server 
	include 'open.php';

	//construct an array in which we'll store our data
	$dataPoints = array();
    $country = $_POST['country'];
	$type = $_POST['type'];

	//we'll soon see how to upgrade our queries so they aren't plain strings
	$sql = "SELECT record_date, $type as c FROM Covid WHERE country = '$country'";

	//execute the query, then run through the result table row by row to
	//put each row's data into our array
	if ($result = mysqli_query($conn,$sql)){	  
	   foreach($result as $row){
	      array_push($dataPoints, array( "label"=> $row["record_date"], "y"=> $row["c"]));
	   }
	}

   // close the connection opened by open.php
   $conn->close();
?>
</body>

<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
    exportEnabled: true,
	theme: "light2",
	title:{
		text: "COVID_19 Data Timeline"
	},
	axisY: {
		title: "Number of Cases except for death data"
	},
	data: [{
		type: "line",
		yValueFormatString: "#,##0.## cases",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   