-- Query 17

--Which year did Netflix have maximum research and development expenses?

DELIMITER //

DROP PROCEDURE IF EXISTS Query_16;

CREATE PROCEDURE Query_16()
BEGIN
    SELECT YEAR(filing_quarter_id) AS year, rd_expense AS 'research and development expenses' 
    FROM Financial 
    WHERE rd_expense = (SELECT MAX(rd_expense) FROM Financial); 
END; //

DELIMITER ;