<head><title>Query 11</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>How many movies were released in 2020 that were produced in France?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_11();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>Number of Movies</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["COUNT(show_id)"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>