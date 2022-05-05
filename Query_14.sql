-- Query 15

--What was the average quarterly net income of Netflix in 2021?

DELIMITER //

DROP PROCEDURE IF EXISTS Query_14;

CREATE PROCEDURE Query_14()
BEGIN
    SELECT FORMAT(AVG(net_income),2) AS 'Average quarterly net income' 
    FROM Financial 
    WHERE YEAR(filing_quarter_id) = '2021'; 
END; //

DELIMITER ;