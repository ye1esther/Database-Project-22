<head><title>Query 15</title></head>
<body>
<?php


	include 'open.php';


	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	$year= $_POST['year'];

	echo "<h2>Show what was the average quarterly net income of Netflix in the given year $year? (DECIMAL 2 PT CAST)
	</h2><br>";


	if (empty($year)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $year."<br><br>";
	
	
		if ($stmt = $conn->prepare("CALL Query_14(?)")) {
	

		$stmt->bind_param("s", $year);
	
		if ($stmt->execute()) {
	
			$result = $stmt->get_result();
	
			if (($result) && ($result->num_rows != 0)) {
		
				echo "<table border=\"1px solid black\">";
				echo "<tr><th> Average Quarterly Net Income </th></tr>";
	
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