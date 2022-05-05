DELIMITER //

DROP PROCEDURE IF EXISTS Query_10 //

CREATE PROCEDURE Query_10()

BEGIN
        SELECT title
        FROM Content
        WHERE date_added = (SELECT MAX(date_added) FROM Content);

END; // 

DELIMITER ;