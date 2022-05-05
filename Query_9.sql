-- Query 9

-- What are the titles of a Netflix movie with the longest duration that was released in 2021?

DELIMITER //

DROP PROCEDURE IF EXISTS Query_9;

CREATE PROCEDURE Query_9()
BEGIN
    DROP VIEW IF EXISTS MINUTE; 
    CREATE VIEW MINUTE AS 
    (SELECT title, type, release_year, CAST(REPLACE(Content.duration, 'min', '') AS INT) as duration 
    From Content
    WHERE type LIKE '%Movie%');
    
    SELECT title
    FROM MINUTE
    WHERE duration = (SELECT MAX(duration) FROM MINUTE WHERE release_year = 2021 AND type LIKE '%Movie%')
    AND release_year = 2021
    ORDER BY title ASC;
END; //

DELIMITER ;