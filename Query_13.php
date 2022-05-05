<head><title>Query 13</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>How many Netflix TVshows were added to Neflix in a month that had over 8,000 daily cases in France in 2020?</h2><br>";

	//construct an array in which we'll store our data
	$dataPoints = array();

	//we'll soon see how to upgrade our queries so they aren't plain strings
	$sql = "CALL Query_13();";

	//execute the query, then run through the result table row by row to
	//put each row's data into our array
	if ($result = mysqli_query($conn,$sql)){	  
	   foreach($result as $row){
	      array_push($dataPoints, array( "label"=> $row["month added to Netflix"], "y"=> $row["number of TV shows"]));
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
		text: "Number of Netflix TV Shows Added When Daily Cases Exceeded 8,000 Cases in France"
	},
	axisY: {
		title: "Number of Shows"
	},
    axisX: {
		title: "Month in 2020"
	},
	data: [{
		type: "column",
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
