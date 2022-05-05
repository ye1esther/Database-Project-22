<head><title>Query 1</title></head>
<body>
<?php

// Yewon Shin
// yshin31

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>How many Netflix shows were released in 2020 that were streamed by Netflix in the United States?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_1();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>The Number of Netflix Shows</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["Number of Shows"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>