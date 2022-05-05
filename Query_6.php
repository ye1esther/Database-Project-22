<head><title>Query 6</title></head>
<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 6 Results Page</h2>";
        echo "<h3>Show what was the total net income of Netflix in the first two quarters of 2020
        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_6();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td> total net income </td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["income"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_6 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>

