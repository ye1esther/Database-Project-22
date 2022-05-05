<head><title>Query 12</title></head>

<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 12 Results Page</h2>";
        echo "<h3>Show how many Netflix movies were added in months that had over 250,000 daily cases in the US

        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_12();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td> Number of movies added </td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["showcount"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_12 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>

