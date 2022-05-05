-- Query 13

-- How many Netflix TVshows were added to Neflix in a month that had 
-- over 8,000 daily cases in France in 2020? 

DELIMITER //

DROP PROCEDURE IF EXISTS Query_13;

CREATE PROCEDURE Query_13()
BEGIN
   WITH selected_month AS (
   SELECT DISTINCT(MONTH(record_date)) AS Month_over, country 
   FROM Covid 
   WHERE country LIKE '%France%' AND YEAR(record_date) = '2020' AND new_case > 8000) 
   
   SELECT MONTH(date_added) AS 'month added to Netflix', COUNT(show_id) as 'number of TV shows' 
   FROM Content, selected_month
   WHERE Content.type LIKE '%TV Show%' AND released_country LIKE '%FRANCE%' AND Year(date_added) = '2020' AND Month(date_added) = Month_over
   GROUP BY MONTH(date_added)
   ORDER BY MONTH(date_added) ASC; 
END; //

DELIMITER ;