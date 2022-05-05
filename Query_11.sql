-- Query 11

-- How many movies were released in 2020 that were produced in France?

DELIMITER //

DROP PROCEDURE IF EXISTS Query_11;

CREATE PROCEDURE Query_11()
BEGIN
    SELECT COUNT(show_id)
    FROM Content 
    WHERE released_country LIKE '%France' AND release_year = 2020; 
END; //

DELIMITER ;