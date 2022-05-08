<head><title>Financial Data Overview</title></head>
<body>
<?php

	//open a connection to dbase server 
	include 'open.php';

	//construct an array in which we'll store our data
	$dataPoints = array();
    $type = $_POST['type'];

	//we'll soon see how to upgrade our queries so they aren't plain strings
	$sql = "SELECT filing_quarter_id, $type AS c FROM Financial";

	// execute the query, then run through the result table row by row to
	//put each row's data into our array
	if ($result = mysqli_query($conn,$sql)){	  
	   foreach($result as $row){
	      array_push($dataPoints, array( "label"=> $row["filing_quarter_id"], "y"=> $row["c"]));
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
	theme: "light3",
	title:{
		text: "Netflix Financial Data"
	},
	axisY: {
		title: "Millions of US $ except per share data"
	},
	data: [{
		type: "line",
		yValueFormatString: "#,##0.## Million of USD (except EPS)",
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