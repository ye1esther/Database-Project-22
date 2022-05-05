-- Query 5

-- What were the most prevalent TV rating of Netflix movies that were released in 2019? 

DELIMITER //

DROP PROCEDURE IF EXISTS Query_5;

CREATE PROCEDURE Query_5()
BEGIN
    SELECT rating, COUNT(show_id) AS 'Number of Shows'
    FROM Content
    WHERE release_year = 2019 AND type LIKE '%Movie%'
    GROUP BY rating
    ORDER BY COUNT(show_id) DESC
    LIMIT 5;
END; //

DELIMITER ;
