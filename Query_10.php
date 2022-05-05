<head><title>Query 10</title></head>

<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 10 Results Page</h2>";
        echo "<h3>Show what was the most recent movie added on Netflix
        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_10();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td> Movie title </td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["title"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_10 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>

