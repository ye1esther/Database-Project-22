<head><title>Query 19</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>What is the title of a Netflix movie with the shortest duration that was added to Netflix when 
    -- COVID-19 daily cases in Japan was over 10,000? </h2><br>";


	//construct an array in which we'll store our data
	$dataPoints = array();

	//we'll soon see how to upgrade our queries so they aren't plain strings
	$sql = "CALL Query_19();";

	//execute the query, then run through the result table row by row to
	//put each row's data into our array
	if ($result = mysqli_query($conn,$sql)){	  
	   foreach($result as $row){
	      array_push($dataPoints, array( "label"=> $row["title"], "y"=> $row["duration"]));
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
		text: "Shortest Movie on Netflix When Daily Case Exceeded 10000 in Japan"
	},
	axisY: {
		title: "Minutes"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## min",
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

