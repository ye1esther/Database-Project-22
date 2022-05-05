DELIMITER //

DROP PROCEDURE IF EXISTS Query_8 //

CREATE PROCEDURE Query_8()
BEGIN

        WITH Highest_daily AS (
               SELECT country 
               FROM Covid 
               WHERE new_case = (SELECT MAX(new_case) FROM Covid WHERE record_date > '2020-01-01 00:00:00' AND record_date < '2021-12-31 11:59:59'
                                AND country NOT LIKE "%World%" AND country NOT LIKE "%High income%" AND country NOT LIKE "%Low income%" AND
                                 country NOT LIKE "%Lower middle income%" AND country NOT LIKE "%North America%" AND country NOT LIKE "%South America%"
                                 AND country NOT LIKE "%Europe%" AND country NOT LIKE "%Africa%" AND country NOT LIKE "%Asis%")                          
               )
               
     
        SELECT COUNT(Content.show_id) AS showcount, Highest_daily.country
        FROM Content, Highest_daily
        WHERE Content.type LIKE '%Movie%' 
        AND Content.released_country LIKE CONCAT('%', Highest_daily.country, '%')
        AND date_added > '2020-01-01 00:00:00' AND date_added < '2021-12-31 11:59:59';


END; //

DELIMITER ;