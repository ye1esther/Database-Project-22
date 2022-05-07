<?php

    $show_id = $_POST['show_id'];
    $sql = "DELETE FROM Content WHERE show_id = '$show_id'";
    $sql2 = "DELETE FROM Influenced_by WHERE show_id = '$show_id'";

    if (!empty($show_id)) {

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