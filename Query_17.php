<head><title>Query 17</title></head>

<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 17 Results Page</h2>";
        echo "<h3>Show what was the average number of COVID-19 daily new cases in Italy in December of 2021


        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_17();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td> Average COVD-19 daily new cases in Italy, December 2021 </td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["average"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_17 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>

