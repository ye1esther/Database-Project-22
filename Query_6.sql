DELIMITER //

DROP PROCEDURE IF EXISTS Query_6 //

CREATE PROCEDURE Query_6()
BEGIN
        SELECT SUM(net_income) AS income 
        FROM Financial
        WHERE filing_quarter_id > '2020-01-01 00:00:00' AND filing_quarter_id < '2020-06-30 11:59:59';
END; // 

DELIMITER ;