<?php

    $filing_quarter_id = $_POST['filing_quarter_id'];
    $sql = "DELETE FROM Financial WHERE filing_quarter_id = '$filing_quarter_id'";

    if (!empty($show_id)) {

        //open a connection to dbase server 
        include 'open.php';

        if ($conn->query($sql)) {
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