<head><title>Query 3</title></head>
<body>
<?php

	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>Which quarter of 2021 did Netflix record the highest earnings per share or highest revenue?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_3();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>Quarter of 2021</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["filing_quarter_id"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>