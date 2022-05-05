<head><title>Query 18</title></head>

<body>
<?php
    //open a connection to dbase server
	//this will require an updated conf.php with appropriate credentials
	include 'open.php';

        // prepare the query statement
        //we'll soon see how to upgrade our queries so they aren't plain strings
        echo "<h2>Query 18 Results Page</h2>";
        echo "<h3>Show how many Netflix TVShows were added to NETFLIX in a month that had maximum deaths per million due to COVID-19 in 2020, South Korea
        </h3>";
        // execute it, and if non-empty result, output each row of result
        if ($result = $conn->query("CALL Query_18();")) {
                echo "<table border=\"2px solid black\">";
                echo "<tr><td> Month</td><td> Number of Shows </td><td> released country </td><td> new deaths per million </td>";
                foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$row["month"]."</td>";
                        echo "<td>".$row["showcount"]."</td>";
                        echo "<td>".$row["rc"]."</td>";
                        echo "<td>".$row["ndp"]."</td>";
                        echo "</tr>";


                }
                echo "</table>";

        }
        else{ 
                echo "Call to Query_18 failed<br>";
        }

        //close the connection opened by open.php since we no longer need access to dbase
        $conn->close();

?>
</body>

