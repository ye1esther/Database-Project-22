<?php
    
    $show_id = $_POST['show_id'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $released_country = $_POST['released_country'];
    $date_added = $_POST['date_added'];
    $release_year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $duration = $_POST['duration'];
    $sql = "INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
    VALUES ('$show_id', '$type', '$title', '$released_country', '$date_added', '$release_year', '$rating', '$duration');";

    if (!empty($show_id) || !empty($type) || !empty($title) || !empty($released_country) || !empty($date_added)
    || !empty($release_year) || !empty($rating) || !empty($duration)) {

        //open a connection to dbase server 
        include 'open.php';

        if ($conn->query($sql)) {
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


   
