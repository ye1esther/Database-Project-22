-- Query 7

--  In which month(s) of 2021 did the United States record the 
-- highest number of deaths per million people?

DELIMITER //

DROP PROCEDURE IF EXISTS Query_7;

CREATE PROCEDURE Query_7()
BEGIN
    SELECT MONTH(record_date)
    FROM Covid
    WHERE new_deaths_per_million = (SELECT MAX(new_deaths_per_million) FROM Covid WHERE country LIKE '%United States%')
    AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-12-31 00:00:00'
    ORDER BY MONTH(record_date) ASC;
END; //

DELIMITER ;
