DELIMITER //

DROP PROCEDURE IF EXISTS Query_4 //

CREATE PROCEDURE Query_4()
BEGIN

       WITH Most_produce AS (
                SELECT released_country AS country, COUNT(show_id) AS showcount
                FROM Content
                GROUP BY released_country 
                ORDER BY COUNT(show_id) DESC
                LIMIT 5
                )
     
        SELECT DISTINCT Covid.country as country, Most_produce.showcount as showcount
        FROM Covid, Most_produce
        WHERE Covid.new_case > 18000 AND Most_produce.country LIKE CONCAT('%', Covid.country, '%')
        ORDER BY showcount DESC, country ASC;
        
END; // 

DELIMITER ;