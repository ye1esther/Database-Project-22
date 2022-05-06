<?php
    
    $country = $_POST['country'];
    $record_date = $_POST['record_date'];
    $sql = "DELETE FROM Covid WHERE country = '$country' AND record_date = '$record_date'";

    $sql2 = "DELETE FROM Influenced_by
                SELECT record_id
                FROM Covid
                WHERE country = '$country'";

    if (!empty($country) || !empty($record_date)) {

        //open a connection to dbase server 
        include 'open.php';

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