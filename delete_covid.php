<?php
    
    $country = $_POST['country'];
    $record_date = $_POST['record_date'];
    $sql = "DELETE FROM Covid WHERE country = '$country' AND record_date = '$record_date'";
    $sql2 = "DELETE FROM Influenced_by WHERE record_id = (SELECT record_id FROM Covid WHERE country = '$country')";

  
    if (!empty($country) || !empty($record_date)) {

        //open a connection to dbase server 
        include 'open.php';

        $valid = $conn->query("SELECT COUNT(*) AS c FROM Covid  WHERE country = '$country' AND record_date = '$record_date'");
        //extract result from query 
        $row = $valid->fetch_assoc();

        if ($row['c'] == '0') {
            echo "ERROR: Record does not exist"; 
            die(); 
        }

        if ($conn->query($sql) && $conn->query($sql2)) {
            echo "Deleted Data Successfully!";
        } else {
            echo "ERROR: ".$sql."<br>".$conn->error;
        }

        $conn->close();

    // if one of the fields was empty
    } else {
        echo "All fields are required";
        die();
    }