DELIMITER //

DROP PROCEDURE IF EXISTS Query_18 //
CREATE PROCEDURE Query_18()
BEGIN


       WITH Max_Deaths AS (
                SELECT DISTINCT MONTH(record_date) AS record_month, new_deaths_per_million 
                FROM Covid 
                WHERE country LIKE '%South Korea%' AND new_deaths_per_million = 
                                                (SELECT MAX(new_deaths_per_million) 
                                                FROM Covid 
                                                WHERE country LIKE '%South Korea%' AND YEAR(record_date) = '2020') 
                                                AND YEAR(record_date) = '2020'
                                                )
        SELECT MONTH(Content.date_added) AS month, COUNT(show_id) AS showcount, released_country as rc, new_deaths_per_million as ndp
        FROM Content, Max_Deaths 
        WHERE type LIKE '%TV SHOW%' AND Content.released_country LIKE '%South Korea%' AND YEAR(Content.date_added) = '2020' AND MONTH(Content.date_added) = record_month
        GROUP BY MONTH(Content.date_added)
        ORDER BY COUNT(show_id) DESC;


END; // 
DELIMITER ;