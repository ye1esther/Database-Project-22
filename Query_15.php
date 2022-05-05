<head><title>Query 15</title></head>

<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 15 Results Page</h2>";
        echo "<h3>Show Which country released the most number of TV shows in 2020? List the name of the country and the number of TV shows they released </h3>";
        $dataPoints = array();

        $sql = "CALL Query_15();";

   
        // execute it, and if non-empty result, output each row of result
        if ($result = mysqli_query($conn,$sql)){	  
            foreach($result as $row){
                array_push($dataPoints, array( "label"=> $row["country"], "y"=> $row["showcount"]));
             }

        }
        else{ 
                echo "Call to Query_15 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
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
		text: "Countries released the most number of TV shows in 2020"
	},
	axisY: {
		title: "Number of Shows"
	},
        axisX: { 
                title: "Country"
        
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