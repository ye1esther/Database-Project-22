<head><title>Content Data Overview</title></head>
<body>
<?php

	//open a connection to dbase server 
	include 'open.php';

	//construct an array in which we'll store our data
	$dataPoints = array();

	//we'll soon see how to upgrade our queries so they aren't plain strings
	$sql = "SELECT date_added, COUNT(show_id) AS c FROM Content WHERE date_added > '2019-01-01 00:00:00' GROUP BY date_added";

	//execute the query, then run through the result table row by row to
	//put each row's data into our array
	if ($result = mysqli_query($conn,$sql)){	  
	   foreach($result as $row){
	      array_push($dataPoints, array( "label"=> $row["date_added"], "y"=> $row["c"]));
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
		text: "Netflix New Show Timeline"
	},
	axisY: {
		title: "Number of Newly Added Shows"
	},
	data: [{
		type: "line",
		yValueFormatString: "#,##0.## shows",
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