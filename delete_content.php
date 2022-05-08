<?php

    $show_id = $_POST['show_id'];
    $count_Content_before = "SELECT COUNT(show_id) FROM Content";
    $sql = "DELETE FROM Content WHERE show_id = '$show_id'";
    $count_Content_after = "SELECT COUNT(show_id) FROM Content";

    $count_IB_before = "SELECT COUNT(show_id) FROM Influenced_by";
    $sql2 = "DELETE FROM Influenced_by WHERE show_id = '$show_id'";
    $count_IB_after = "SELECT COUNT(show_id) FROM Influenced_by";

    if (!empty($show_id)) {

        //open a connection to dbase server 
        include 'open.php';

        if ($conn->query($sql) && $conn->query($sql2)) {
            if ($count_Content_after == $count_Content_after) { 
                echo "ERROR: Non existing record";
            } else { 
                echo "Deleted Data Successfully!";
            }
            //여기 이것도 필요한지 모르겠는데 혹시나 !!
            if ($count_IB_after == $count_IB_before) { 
                echo "ERROR: Non existing record";
            } 
        } else {
            echo "ERROR: ".$sql."<br>".$conn->error;
        }

        $conn->close();

    // if one of the fields was empty
    } else {
        echo "All fields are required";
        die();
    }