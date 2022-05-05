-- Query 3

-- Which quarter of 2021 did Netflix record the highest 
-- earnings per share or highest revenue?

DELIMITER //

DROP PROCEDURE IF EXISTS Query_3;

CREATE PROCEDURE Query_3()
BEGIN
    SELECT filing_quarter_id
    FROM Financial
    WHERE earnings_per_share = (SELECT MAX(earnings_per_share) FROM Financial)
            AND filing_quarter_id > '2021-01-01 00:00:00' AND filing_quarter_id < '2021-12-31 00:00:00';
END; //

DELIMITER ;
