DELIMITER //

DROP PROCEDURE IF EXISTS Query_15 //

CREATE PROCEDURE Query_15()

BEGIN

      SELECT released_country AS country, COUNT(show_id) AS showcount
      FROM Content
      WHERE Content.type LIKE '%TV Show%' AND release_year = 2020
      GROUP BY released_country 
      ORDER BY COUNT(show_id) DESC, country ASC
      LIMIT 5;

END; // 

DELIMITER ;