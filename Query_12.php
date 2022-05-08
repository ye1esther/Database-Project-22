<head><title>Query 12</title></head>

<body>
<?php

	include 'open.php';

	


	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	$num = $_POST['number'];

	echo "<h2>Show how many Netflix movies were added in months that had over $num the daily cases in the US
        </h2><br>";

	if (empty($num)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $num."<br><br>";
	
		if ($stmt = $conn->prepare("CALL Query_12(?)")) {
	

		$stmt->bind_param("i", $num);
	
		if ($stmt->execute()) {
	
			$result = $stmt->get_result();
	
			if (($result) && ($result->num_rows != 0)) {
		
				echo "<table border=\"1px solid black\">";
				echo "<tr><th>  Number of movies added</th></tr>";
	
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
	
	$conn->close();

 
?>
</body>

