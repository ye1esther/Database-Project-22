-- Query 20

-- What is the title of a Netflix movie with the shortest duration that was added to Netflix when 
-- COVID-19 daily cases in Japan was over 10,000? 

DELIMITER //

DROP PROCEDURE IF EXISTS Query_19;

CREATE PROCEDURE Query_19()
BEGIN
    DROP VIEW IF EXISTS MINUTE; 
    CREATE VIEW MINUTE AS 
    (SELECT title, type, date_added, CAST(REPLACE(Content.duration, 'min', '') AS INT) as duration 
    From Content
    WHERE type LIKE '%Movie%');
    
    WITH Covid_record AS (
            SELECT DISTINCT record_date
            FROM Covid
            WHERE new_case > 10000 AND country LIKE '%Japan%'
            )
    
    SELECT title, date_added, duration
    FROM MINUTE, Covid_record
    WHERE duration = (SELECT MIN(duration) FROM MINUTE WHERE MINUTE.date_added = Covid_record.record_date)
            AND MINUTE.date_added = Covid_record.record_date
    ORDER BY duration ASC
    LIMIT 5;
END; //

DELIMITER ;