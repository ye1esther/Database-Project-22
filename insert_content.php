<?php
    
    $show_id = $_POST['show_id'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $released_country = $_POST['released_country'];
    $date_added = $_POST['date_added'];
    $release_year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $duration = $_POST['duration'];
    
    //separate input validation check for duration 
    if ($type == 'TV Show' && strpos($duration, 'min') !== false) { 
        echo "ERROR: Duration for TV Show must be in Seasons, not minutes. Please correct the error and try again.";
        die();
    }
    else if ($type == 'Movie' && strpos($duration, 'Season') !== false) { 
        echo "ERROR: Duration for Movie must be in min, not Seasons. Please correct the error and try again.";
        die();
    }

    $sql = "INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
    VALUES ('$show_id', '$type', '$title', '$released_country', '$date_added', '$release_year', '$rating', '$duration');";

    $sql2 = "INSERT INTO Influenced_by
                SELECT Content.show_id, Covid.record_id
                FROM Content, Covid
                WHERE show_id = '$show_id' AND Content.released_country = Covid.country;";

    if (!empty($show_id) || !empty($type) || !empty($title) || !empty($released_country) || !empty($date_added)
    || !empty($release_year) || !empty($rating) || !empty($duration)) {

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


   
