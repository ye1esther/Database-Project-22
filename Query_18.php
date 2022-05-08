<head><title>Query 18</title></head>

<body>
<?php

	include 'open.php';

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	$country = $_POST['country'];

	echo "<h2>Show how many Netflix TVShows were added to NETFLIX in a month that had maximum deaths per million due to COVID-19 in 2020 in $country
        </h2><br>";

	if (empty($country)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $country."<br><br>";
	
	
		if ($stmt = $conn->prepare("CALL Query_18(?)")) {
	
		$stmt->bind_param("s", $country);
	
		if ($stmt->execute()) {
	
			$result = $stmt->get_result();
	
			if (($result) && ($result->num_rows != 0)) {
		
				echo "<table border=\"1px solid black\">";
                                echo "<tr><td> Month</td><td> Number of Shows added to Netflix</td><td> new deaths per million </td>";
	
				while ($row = $result->fetch_row()) {
					echo "<tr>";
					echo "<td>".$row[0]."</td>";
                                        echo "<td>".$row[1]."</td>";
                                        echo "<td>".$row[2]."</td>";
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

