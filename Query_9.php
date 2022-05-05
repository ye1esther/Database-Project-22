<head><title>Query 9</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2> What are the titles of a Netflix movie with the longest duration that was released in 2021?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_9();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>Title of the Movie</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["title"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>