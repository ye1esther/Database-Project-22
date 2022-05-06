<?php
    
    $country = $_POST['country'];
    $record_date = $_POST['record_date'];
    $total_case = $_POST['total_case'];
    $new_case = $_POST['new_case'];
    $new_deaths_per_million = $_POST['new_deaths_per_million'];
    $date = substr($record_date,0,10);
    $record_id = $country." ".$date;
    $sql = "INSERT INTO Covid(country, record_date, total_case, new_case, new_deaths_per_million, record_id)
    VALUES ('$country', '$record_date', '$total_case', '$new_case', '$new_deaths_per_million', '$record_id');";

    $sql2 = "INSERT INTO Influenced_by
               SELECT Content.show_id, Covid.record_id
               FROM Content, Covid
               WHERE Covid.record_id = '$record_id' AND Content.released_country = Covid.country;";
    if (!empty($country) || !empty($record_id) || !empty($total_case) || !empty($new_case) || !empty($new_deaths_per_million)
    || !empty($record_id) ) {

        //open a connection to dbase server 
        include 'open.php';

        if ($conn->query($sql) && $conn->query($sql2)) {
            echo "Inserted Data Successfully!";
        } else {
            echo "ERROR: ".$sql."<br>".$conn->error;
        }

        $conn->close();

    // if one of the fields was empty
    } else {
        echo "All fields are required";
        die();
    }
