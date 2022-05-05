DELIMITER //

DROP PROCEDURE IF EXISTS Query_17 //
CREATE PROCEDURE Query_17()
BEGIN


        SELECT AVG(new_case) AS average
        FROM Covid
        WHERE MONTH(record_date) = 12 AND YEAR(record_date) = 2021
              AND country LIKE '%Italy%';


END; // 

DELIMITER ;