<head><title>Query 7</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>In which month(s) of 2021 did the United States record the highest number of deaths per million people?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_7();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>Month of 2021</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["MONTH(record_date)"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>