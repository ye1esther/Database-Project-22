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


    include 'open.php'; 

    $sql = "INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
    VALUES (?,?,?,?,?,?,?,?);";

    $sql2 = "INSERT INTO Influenced_by
                SELECT Content.show_id, Covid.record_id
                FROM Content, Covid
                WHERE show_id LIKE CONCAT('%',?,'%')AND Content.released_country = Covid.country;";

    if (!empty($show_id) || !empty($type) || !empty($title) || !empty($released_country) || !empty($date_added)
    || !empty($release_year) || !empty($rating) || !empty($duration)) {

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssss", $show_id, $type, $title, $released_country,$date_added, $release_year, $rating, $duration);

            if ($stmt->execute()) {
                
                echo "inserted successfully to Content table";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("s", $show_id); 
                $stmt2->execute();

            } else { 
                echo "Prepare failed.<br>";
		        $error = $conn->errno . ' ' . $conn->error;
		        echo $error; 
            }
        }else { 
            echo "Execute failed.<br>";
        }
		$stmt->close();
        $stmt2->close();

    } else {
        echo "All fields are required";
        die();
    }

    $conn->close();

?>
</body>