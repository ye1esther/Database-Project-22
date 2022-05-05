DELIMITER //

DROP PROCEDURE IF EXISTS Query_12 //

CREATE PROCEDURE Query_12()

BEGIN
        WITH Covid_record AS (
                SELECT DISTINCT record_date
                FROM Covid
                WHERE new_case > 250000 AND country LIKE '%United States%'
                )
        
        SELECT COUNT(Content.show_id) AS showcount
        FROM Content, Covid_record
        WHERE Content.type LIKE '%Movie%' AND MONTH(Content.date_added) = MONTH(Covid_record.record_date) 
              AND YEAR(Content.date_added) = YEAR(Covid_record.record_date);


END; // 

DELIMITER ;