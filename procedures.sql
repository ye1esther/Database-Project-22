-- procedures.sql combines all the procedures needed to run queries on our php files

-- Query 1

DELIMITER //

DROP PROCEDURE IF EXISTS Query_1;

CREATE PROCEDURE Query_1(IN rc VARCHAR(30))
BEGIN
        SELECT COUNT(show_id) AS 'Number of Shows'
        FROM Content
        WHERE release_year = 2020 AND released_country LIKE CONCAT("%", rc, "%");
END; //

DELIMITER ;

-- Query 2

DELIMITER //

DROP PROCEDURE IF EXISTS Query_2 //

CREATE PROCEDURE Query_2()

BEGIN

        SELECT AVG(new_case) AS Average
        FROM Covid
        WHERE country LIKE '%United States%' AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-05-31 00:00:00';


END; //

DELIMITER ;

-- Query 3

DELIMITER //

DROP PROCEDURE IF EXISTS Query_3;

CREATE PROCEDURE Query_3(IN yr INT(4))
BEGIN
    SELECT filing_quarter_id
    FROM Financial
    WHERE earnings_per_share = (SELECT MAX(earnings_per_share) FROM Financial 
                                WHERE YEAR(filing_quarter_id) LIKE CONCAT("%", yr, "%"))
            AND YEAR(filing_quarter_id) LIKE CONCAT("%", yr, "%");
END; //

DELIMITER ;

-- Query 4

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

-- Query 5

DELIMITER //

DROP PROCEDURE IF EXISTS Query_5;

CREATE PROCEDURE Query_5(IN yr INT(4))
BEGIN
    SELECT rating, COUNT(show_id) AS 'Number of Shows'
    FROM Content
    WHERE release_year LIKE CONCAT("%", yr, "%") AND type LIKE '%Movie%'
    GROUP BY rating
    ORDER BY COUNT(show_id) DESC
    LIMIT 5;
END; //

DELIMITER ;

-- Query 6

DELIMITER //

DROP PROCEDURE IF EXISTS Query_6 //

CREATE PROCEDURE Query_6()
BEGIN
        SELECT SUM(net_income) AS income 
        FROM Financial
        WHERE filing_quarter_id > '2020-01-01 00:00:00' AND filing_quarter_id < '2020-06-30 11:59:59';
END; // 

DELIMITER ;

-- Query 7

DELIMITER //

DROP PROCEDURE IF EXISTS Query_7;

CREATE PROCEDURE Query_7(IN c VARCHAR(30))
BEGIN
    SELECT MONTH(record_date)
    FROM Covid
    WHERE new_deaths_per_million = (SELECT MAX(new_deaths_per_million) FROM Covid WHERE country LIKE CONCAT("%", c, "%")
                                    AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-12-31 00:00:00')
    AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-12-31 00:00:00'
    AND country LIKE CONCAT("%", c, "%")
    ORDER BY MONTH(record_date) ASC;
END; //

DELIMITER ;

-- Query 8

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

-- Query 9

DELIMITER //

DROP PROCEDURE IF EXISTS Query_9;

CREATE PROCEDURE Query_9(IN yr INT(4))
BEGIN
    DROP VIEW IF EXISTS MINUTE; 
    CREATE VIEW MINUTE AS 
    (SELECT title, type, release_year, CAST(REPLACE(Content.duration, 'min', '') AS INT) as duration 
    From Content
    WHERE type LIKE '%Movie%');
    
    SELECT title, duration
    FROM MINUTE
    WHERE duration = (SELECT MAX(duration) FROM MINUTE WHERE release_year LIKE CONCAT("%", yr, "%") AND type LIKE '%Movie%')
    AND release_year LIKE CONCAT("%", yr, "%")
    ORDER BY title ASC;
END; //

DELIMITER ;

-- Query 10

DELIMITER //

DROP PROCEDURE IF EXISTS Query_10 //

CREATE PROCEDURE Query_10()

BEGIN
        SELECT title
        FROM Content
        WHERE date_added = (SELECT MAX(date_added) FROM Content);

END; // 

DELIMITER ;

-- Query 11

DELIMITER //

DROP PROCEDURE IF EXISTS Query_11;

CREATE PROCEDURE Query_11(IN c VARCHAR(30))
BEGIN
    SELECT COUNT(show_id)
    FROM Content 
    WHERE released_country LIKE CONCAT("%", c, "%") AND release_year = 2020; 
END; //

DELIMITER ;

-- Query 12

DELIMITER //

DROP PROCEDURE IF EXISTS Query_12 //

CREATE PROCEDURE Query_12()

BEGIN
        WITH Covid_record AS (
                SELECT DISTINCT record_date
                FROM Covid
                WHERE new_case > 250000 AND country LIKE '%United States%'
                )
        
        SELECT COUNT(Content.show_id) AS showcount
        FROM Content, Covid_record
        WHERE Content.type LIKE '%Movie%' AND MONTH(Content.date_added) = MONTH(Covid_record.record_date) 
              AND YEAR(Content.date_added) = YEAR(Covid_record.record_date);


END; // 

DELIMITER ;

-- Query 13

DELIMITER //

DROP PROCEDURE IF EXISTS Query_13;

CREATE PROCEDURE Query_13(IN c VARCHAR(30))
BEGIN
   WITH selected_month AS (
   SELECT DISTINCT(MONTH(record_date)) AS Month_over, country 
   FROM Covid 
   WHERE country LIKE CONCAT("%", c, "%") AND YEAR(record_date) = '2020' AND new_case > 8000) 
   
   SELECT MONTH(date_added) AS 'month added to Netflix', COUNT(show_id) as 'number of TV shows' 
   FROM Content, selected_month
   WHERE Content.type LIKE '%TV Show%' AND released_country LIKE CONCAT("%", c, "%") AND Year(date_added) = '2020' AND Month(date_added) = Month_over
   GROUP BY MONTH(date_added)
   ORDER BY MONTH(date_added) ASC; 
END; //

-- Query 14

DELIMITER //

DROP PROCEDURE IF EXISTS Query_14;

CREATE PROCEDURE Query_14()
BEGIN
    SELECT FORMAT(AVG(net_income),2) AS 'Average quarterly net income' 
    FROM Financial 
    WHERE YEAR(filing_quarter_id) = '2021'; 
END; //

DELIMITER ;

-- Query 15

DELIMITER //

DROP PROCEDURE IF EXISTS Query_15 //

CREATE PROCEDURE Query_15(IN yr INT(4))

BEGIN

      SELECT released_country AS country, COUNT(show_id) AS showcount
      FROM Content
      WHERE Content.type LIKE '%TV Show%' AND release_year LIKE CONCAT("%", yr, "%")
      GROUP BY released_country 
      ORDER BY COUNT(show_id) DESC, country ASC
      LIMIT 5;

END; // 

DELIMITER ;

-- Query 16

DELIMITER //

DROP PROCEDURE IF EXISTS Query_16;

CREATE PROCEDURE Query_16()
BEGIN
    SELECT YEAR(filing_quarter_id) AS year, rd_expense AS 'research and development expenses' 
    FROM Financial 
    WHERE rd_expense = (SELECT MAX(rd_expense) FROM Financial); 
END; //

DELIMITER ;

-- Query 17

DELIMITER //

DROP PROCEDURE IF EXISTS Query_17 //
CREATE PROCEDURE Query_17(IN c VARCHAR(30))
BEGIN


        SELECT AVG(new_case) AS average
        FROM Covid
        WHERE MONTH(record_date) = 12 AND YEAR(record_date) = 2021
              AND country LIKE CONCAT("%", c, "%");


END; // 

DELIMITER ;

-- Query 18

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
        SELECT MONTH(Content.date_added) AS month, COUNT(show_id) AS showcount, new_deaths_per_million as ndp
        FROM Content, Max_Deaths 
        WHERE type LIKE '%TV SHOW%' AND YEAR(Content.date_added) = '2020' AND MONTH(Content.date_added) = record_month
        GROUP BY MONTH(Content.date_added)
        ORDER BY COUNT(show_id) DESC;


END; // 
DELIMITER ;

-- Query 19

DELIMITER //

DROP PROCEDURE IF EXISTS Query_19;

CREATE PROCEDURE Query_19(IN num INT(10))
BEGIN
    DROP VIEW IF EXISTS MINUTE; 
    CREATE VIEW MINUTE AS 
    (SELECT title, type, date_added, CAST(REPLACE(Content.duration, 'min', '') AS INT) as duration 
    From Content
    WHERE type LIKE '%Movie%');
    
    WITH Covid_record AS (
            SELECT DISTINCT record_date
            FROM Covid
            WHERE new_case > num AND country LIKE '%Japan%'
            )
    
    SELECT title, duration
    FROM MINUTE, Covid_record
    WHERE duration = (SELECT MIN(duration) FROM MINUTE WHERE MINUTE.date_added = Covid_record.record_date)
            AND MINUTE.date_added = Covid_record.record_date 
    ORDER BY duration ASC
    LIMIT 5;
END; //

DELIMITER ;