<head><title>Query 17</title></head>
<body>
<?php


	//open a connection to dbase server 
	include 'open.php';

	// echo some basic header info onto the page
	echo "<h2>Which year did Netflix have maximum research and development expenses?</h2><br>";


       // call the stored procedure we already defined on dbase
	   	$result = $conn->query("CALL Query_16();");

			echo "<table border=\"2px solid black\">";
			echo "<tr><td>Year</td><td>Research and Development Expenses</td></tr>";
			foreach($result as $row){
			echo "<tr>";
			echo "<td>".$row["year"]."</td>";
            echo "<td>".$row["research and development expenses"]."</td>";
			echo "</tr>";
			}
			// close table
			echo "</table>";


   // close the connection opened by open.php
   $conn->close();
?>
</body>