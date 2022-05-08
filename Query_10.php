<head><title>Query 10</title></head>

<body>
<?php


	//open a connection to dbase server 
	include 'open.php';

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	$type = $_POST['type'];

	echo "<h2>Show what was the most recent $type added on Netflix
        </h2><br>";

	if (empty($type)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $type."<br><br>";
	
	
		if ($stmt = $conn->prepare("CALL Query_10(?)")) {
	
	
		$stmt->bind_param("s", $type);
	
		if ($stmt->execute()) {
	
			$result = $stmt->get_result();
	
			if (($result) && ($result->num_rows != 0)) {
		
				echo "<table border=\"1px solid black\">";
				echo "<tr><th> Movie title </th></tr>";
	
				while ($row = $result->fetch_row()) {
					echo "<tr>";
					echo "<td>".$row[0]."</td>";
					echo "</tr>";
				} 
			
		
				echo "</table>";
				
			}	else {
	
				echo "No record found for the specified country";
	
			}
	
			$result->free_result();
		
		} else {
	
			
			echo "Execute failed.<br>";
		}
	
		$stmt->close();
	
		} else {
	
		
		echo "Prepare failed.<br>";
		$error = $conn->errno . ' ' . $conn->error;
		echo $error; 
		}
	
	}
	
	//Close the connection created in open.php
	$conn->close();


?>
</body>

