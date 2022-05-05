DELIMITER //

DROP PROCEDURE IF EXISTS Query_2 //

CREATE PROCEDURE Query_2()

BEGIN

        SELECT AVG(new_case) AS Average
        FROM Covid
        WHERE country LIKE '%United States%' AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-05-31 00:00:00';


END; //

DELIMITER ;