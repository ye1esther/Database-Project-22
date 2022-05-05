<head><title>Query 15</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>What was the average quarterly net income of Netflix in 2021?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_14();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>Average Quarterly Net Income</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["Average quarterly net income"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>