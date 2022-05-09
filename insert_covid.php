<?php
    
    $country = $_POST['country'];
    $record_date = $_POST['record_date'];
    $total_case = $_POST['total_case'];
    $new_case = $_POST['new_case'];
    $new_deaths_per_million = $_POST['new_deaths_per_million'];
    $date = substr($record_date,0,10);
    $record_id = $country." ".$date;
    $sql = "INSERT INTO Covid(country, record_date, total_case, new_case, new_deaths_per_million, record_id)
    VALUES (?,?,?,?,?,?);";

    
    $sql2 = "INSERT INTO Influenced_by
               SELECT Content.show_id, Covid.record_id
               FROM Content, Covid
               WHERE Covid.record_id LIKE CONCAT('%',?,'%') AND Content.released_country LIKE CONCAT('%',Covid.country,'%');";
    
    include 'open.php';

    if (!empty($country) || !empty($record_id) || !empty($total_case) || !empty($new_case) || !empty($new_deaths_per_million)
    || !empty($record_id) ) {

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $country, $record_date, $total_case, $new_case, $new_deaths_per_million, $record_id);

            if ($stmt->execute()) {
                
                echo "inserted successfully to Covid table";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("s", $record_id); 
                if ($stmt2->execute()) { 
                    echo "inserted to Influenced by";
                } else { 
                    echo "inserted to Infleunced by unsuccessful";
                }
                

            } else { 
                echo "insertion unsuccessful";
            }
        }else { 
            echo "Execute failed.<br>";
        }
		$stmt->close();
        $stmt2->close();

    } else {
        echo "Prepare failed.<br>";
		$error = $conn->errno . ' ' . $conn->error;
		echo $error; 
    }


    $conn->close();

?>
</body>