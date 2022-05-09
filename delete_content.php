<head><title>Delete from Financial</title></head>
<body>
<?php

    //open a connection to dbase server 
	include 'open.php';

    //Collect the posted value in a variable 
    $show_id = $_POST['show_id'];
    $sql = "DELETE FROM Content WHERE show_id = '$show_id'";
    $sql2 = "DELETE FROM Influenced_by WHERE show_id = '$show_id'";

    //Override the PHP configuration file to display all errors
	//This is useful during development but generally disabled before release
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	//Determine if any input was actually collected
	if (empty($show_id)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $show_id."<br><br>";
	
		//Prepare a statement that we can later execute. The ?'s are placeholders for
		//parameters whose values we will set before we run the query.
		if ($stmt = $conn->prepare("DELETE FROM Content WHERE show_id = '$show_id'")) {
	
		//Run the actual query
		if ($stmt->execute()) {
	
                echo "Deleted Data Successfully in Content!<br><br>";

                if ($stmt2 = $conn->prepare("DELETE FROM Influenced_by WHERE show_id = '$show_id'")) {
                    
                    //Run the actual query
                    if ($stmt2->execute()) {

                        echo "Deleted Data Successfully in Influenced_by!";
       
                    } else {
        
                        //Call to execute failed, e.g. because server is no longer reachable,
                        //or because supplied values are of the wrong type
                        echo "Execute failed.<br>";
                    }

                } else {
                    //A problem occurred when preparing the statement; check for syntax errors
                    //and misspelled attribute names in the statement string.
                    echo "Prepare failed.<br>";
                    $error = $conn->errno . ' ' . $conn->error;
                    echo $error; 
		        } 
                
		} else {
	
		    //Call to execute failed, e.g. because server is no longer reachable,
		    //or because supplied values are of the wrong type
			echo "Execute failed.<br>";
		}
	
		//Close down the prepared statement
		$stmt->close();
        $stmt2->close();
	
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
