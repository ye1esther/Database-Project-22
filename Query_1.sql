-- Query 1

-- How many Netflix shows were released in 2020 that were streamed by 
-- Netflix in the United States? 

DELIMITER //

DROP PROCEDURE IF EXISTS Query_1;

CREATE PROCEDURE Query_1()
BEGIN
    SELECT COUNT(show_id) AS 'Number of Shows'
    FROM Content
    WHERE release_year = 2020 AND released_country LIKE '%United States%';
END; //

DELIMITER ;

