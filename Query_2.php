<head><title>Query 2</title></head>
<body>
<?php
        //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 2 Results Page</h2>";
        echo "<h3> Show the average number of daily new confirmed Covid-19 cases in the United States between January 2021 and May 2021
        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_2();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td> Average newly confirmed Covid-19 cases</td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["Average"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_2 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>
