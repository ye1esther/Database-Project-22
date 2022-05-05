<head><title>Query 8</title></head>


<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 8 Results Page</h2>";
        echo "<h3>Show How many Netflix movies were added to Netflix in 2020 and 2021 in a country that had the highest number of daily cases in the same period
        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_8();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td>Country</td><td> Number of Netflix movies added </td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["country"]."</td>";
                        echo "<td>".$row["showcount"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_8 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>

