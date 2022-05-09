<?php
    

    //open a connection to dbase server 
	include 'open.php';

    //Collect the posted value in a variable 
    $country = $_POST['country'];
    $record_date = $_POST['record_date'];
    $sql = "DELETE FROM Covid WHERE country = '$country' AND record_date = '$record_date'";
    $sql2 = "DELETE FROM Influenced_by WHERE record_id = (SELECT record_id FROM Covid WHERE country = '$country')";

    //Override the PHP configuration file to display all errors
	//This is useful during development but generally disabled before release
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);

	//Determine if any input was actually collected
	if (empty($country) || empty($record_date)) {
		echo "empty <br><br>";
	
	} else {
	
		echo $country."<br><br>";
        echo $record_date."<br><br>";
	
		//Prepare a statement that we can later execute. The ?'s are placeholders for
		//parameters whose values we will set before we run the query.
		if ($stmt = $conn->prepare($sql)) {
	
		//Run the actual query
		if ($stmt->execute()) {

            echo "Deleted Data Successfully in Covid! <br><br>";

            if ($stmt2 = $conn->prepare($sql2)) {
                    
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
	



  
