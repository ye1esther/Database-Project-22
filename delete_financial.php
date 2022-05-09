<head><title>Delete from Financial</title></head>
<body>
<?php

    //open a connection to dbase server 
	include 'open.php';

    //Collect the posted value in a variable 
    $filing_quarter_id = $_POST['filing_quarter_id'];
    $sql = "DELETE FROM Financial WHERE filing_quarter_id = '$filing_quarter_id'";

    //Override the PHP configuration file to display all errors
	//This is useful during development but generally disabled before release
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);



	//Determine if any input was actually collected
	if (empty($filing_quarter_id)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $filing_quarter_id."<br><br>";
	
		//Prepare a statement that we can later execute. The ?'s are placeholders for
		//parameters whose values we will set before we run the query.
		if ($stmt = $conn->prepare($sql)) {
	
		//Run the actual query
        if ($stmt->execute()) {
	
            echo "Deleted Data Successfully!";

		} else {
	
		//Call to execute failed, e.g. because server is no longer reachable,
		//or because supplied values are of the wrong type
		echo "Execute failed.<br>";
		}
	
		//Close down the prepared statement
		$stmt->close();
	
		} else {
	
			//A problem occurred when preparing the statement; check for syntax errors
			//and misspelled attribute names in the statement string.
		echo "Prepare failed.<br>";
		$error = $conn->errno . ' ' . $conn->error;
		echo $error; 
		}
	
	}
	
	//Close the connection created in open.php
	$conn->close();
?>
</body>