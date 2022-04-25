
-- Question 1. How many Netflix shows were released in 2020 that were streamed by 
-- Netflix in the United States? 

        SELECT COUNT(show_id)
        FROM Content
        WHERE release_year = 2020 AND released_country LIKE '%United States%';
        
-- Question 2. What was the average number of daily new confirmed Covid-19 cases in the 
-- United States between January 2021 and May 2021? 

        SELECT AVG(new_case)
        FROM Covid
        WHERE country LIKE '%United States%' AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-05-31 00:00:00';
     
-- Question 3. Which quarter of 2021 did Netflix record the highest earnings per share or highest revenue?

        SELECT filing_quarter_id
        FROM Financial
        WHERE earnings_per_share = (SELECT MAX(earnings_per_share) FROM Financial)
                AND filing_quarter_id > '2021-01-01 00:00:00' AND filing_quarter_id < '2021-12-31 00:00:00';
                
-- Question 4. Which country produced the most number of Netflix TV shows when the number of worldwide new 
-- daily Covid-19 cases was greater than 18,000? 

        WITH Most_produce AS (
                SELECT released_country AS country, COUNT (show_id)
                FROM Content
                GROUP BY released_country 
                ORDER BY COUNT (show_id) DESC
                LIMIT 1
                )
     
        SELECT DISTINCT Covid.country
        FROM Covid, Most_produce
        WHERE Covid.new_case > 18000 AND Most_produce.country LIKE CONCAT('%', Covid.country, '%');
        
 -- Question 5. What was the most prevalent TV rating of Netflix movies that were released in 2019? 
 
        SELECT rating
        FROM Content
        WHERE release_year = 2019 AND type LIKE '%Movie%'
        GROUP BY rating
        ORDER BY COUNT (show_id) DESC
        LIMIT 1;
        
 -- Question 6.  What was the total net income of Netflix in the first two quarters of 2020?
 
        SELECT SUM (net_income)
        FROM Financial
        WHERE filing_quarter_id > '2020-01-01 00:00:00' AND filing_quarter_id < '2020-06-30 11:59:59';
        
-- Question 7.  In which month(s) of 2021 did the United States record the highest number of deaths per million people?
        
        SELECT MONTH(record_date)
        FROM Covid
        WHERE new_deaths_per_million = (SELECT MAX(new_deaths_per_million) FROM Covid WHERE country LIKE '%United States%')
        AND record_date > '2021-01-01 00:00:00' AND record_date < '2021-12-31 00:00:00';

        
 -- Question 8. How many Netflix movies were streamed in 2020 and 2021 in a country that had the highest number 
 -- of daily cases in the same period?
        
        
        WITH Highest_daily AS (
               SELECT country 
               FROM Covid 
               WHERE new_case = (SELECT MAX(new_case) FROM Covid WHERE record_date > '2020-01-01 00:00:00' AND record_date < '2021-12-31 11:59:59'
                                AND country NOT LIKE "%World%" AND country NOT LIKE "%High income%" AND country NOT LIKE "%Low income%" AND
                                 country NOT LIKE "%Lower middle income%" AND country NOT LIKE "%North America%" AND country NOT LIKE "%South America%"
                                 AND country NOT LIKE "%Europe%" AND country NOT LIKE "%Africa%" AND country NOT LIKE "%Asis%")                          
               )
               
     
        SELECT COUNT (Content.show_id)
        FROM Content, Highest_daily
        WHERE Content.type LIKE '%Movie%' 
        AND Content.released_country LIKE CONCAT('%', Highest_daily.country, '%')
        AND date_added > '2020-01-01 00:00:00' AND date_added < '2021-12-31 11:59:59';
        
        
-- Question 9. What are the titles of a Netflix movie with the longest duration that was released in 2021?
        
        
        DROP VIEW IF EXISTS MINUTE; 
        CREATE VIEW MINUTE AS 
        (SELECT title, type, release_year, CAST(REPLACE(Content.duration, 'min', '') AS INT) as duration 
        From Content
        WHERE type LIKE '%Movie%');
        
        SELECT title
        FROM MINUTE
        WHERE duration = (SELECT MAX(duration) FROM MINUTE WHERE release_year = 2021 AND type LIKE '%Movie%')
        AND release_year = 2021
        ORDER BY title ASC;
 
-- Question 10. What was the most recent movie added on Netflix? 

        SELECT title
        FROM Content
        WHERE date_added = (SELECT MAX(date_added) FROM Content);
        
        
        
-- Question 11. How many movies were released in 2020 that were produced in France?

        SELECT COUNT(show_id)
        FROM Content 
        WHERE released_country LIKE '%France' AND release_year = 2020; 

        
-- Question 12. How many Netflix movies were added in months that had over 250,000 daily cases in the US? 
        
        WITH Covid_record AS (
                SELECT DISTINCT record_date
                FROM Covid
                WHERE new_case > 250000 AND country LIKE '%United States%'
                )
        
        SELECT COUNT(Content.show_id) 
        FROM Content, Covid_record
        WHERE Content.type LIKE '%Movie%' AND MONTH(Content.date_added) = MONTH(Covid_record.record_date) 
              AND YEAR(Content.date_added) = YEAR(Covid_record.record_date);


-- Question 13. How many Netflix TVshows were added to Neflix in a month that had over 8,000 daily cases in France in 2020? 
-- if multiple months, then list ... 
-- first find out months that had over 
   
   WITH selected_month AS (
   SELECT DISTINCT(MONTH(record_date)) AS Month_over, country 
   FROM Covid 
   WHERE country LIKE '%France%' AND YEAR(record_date) = '2020' AND new_case > 8000) 
   
   SELECT COUNT(show_id) as 'number of TV shows', MONTH(date_added) AS 'month added to Netflix' 
   FROM Content, selected_month
   WHERE Content.type LIKE '%TV Show%' AND released_country LIKE '%FRANCE%' AND Year(date_added) = '2020' AND Month(date_added) = Month_over
   GROUP BY MONTH(date_added)
   ORDER BY COUNT(show_id) DESC; 
   

-- Question 14. What was the net income of Netflix when the daily new confirmed cases exceeded 12,000 daily 
-- cases at least for a day in a quarter in the US? Please list the income statement's filed date and the 
-- Neflix's corresponding net income for the quarter. 


        CREATE FUNCTION find_quarter(@date DATETIME)
        RETURNS DATETIME AS
        BEGIN
                DECLARE @return_value DATETIME
                IF (@date) >= 1 AND MONTH(@date) <= 3 AND YEAR(@date) = 2019) THEN 
                SET @return_value = '2019-03-31 00:00:00'
                
                RETURN @return_value
        END;   
        
        With Covid_record AS (
                SELECT DISTINCT record_date
                FROM Covid
                WHERE new_case > 250000 AND country LIKE '%United States%'
                )
        
        SELECT DISTINCT filing_quarter_id, net_income
        FROM Financial, Covid_record
        WHERE MONTH(Financial.filing_quarter_id) = MONTH(Covid_record.record_date) 
              AND YEAR(Financial.filing_quarter_id) = YEAR(Covid_record.record_date);

-- Question 15. What was the average quarterly net income of Netflix in 2021? (DECIMAL 2 PT CAST)
        SELECT FORMAT(AVG(net_income),2) AS 'Average quarterly net income' 
        FROM Financial 
        WHERE YEAR(filing_quarter_id) = '2021'; 
 

-- Question 16. Which country released the most number of TV shows in 2020? List the name of the country and the number of 
-- TV shows they released.

  
        SELECT released_country AS country, COUNT (show_id) AS 'Number of TV Shows'
        FROM Content
        WHERE Content.type LIKE '%TV Show%' AND release_year = 2020
        GROUP BY released_country 
        ORDER BY COUNT (show_id) DESC
        LIMIT 1;
                

-- Question 17. Which year did Netflix have maximum research and development expenses? + expense 
        SELECT YEAR(filing_quarter_id) AS year, rd_expense AS 'research and development expenses' 
        FROM Financial 
        WHERE rd_expense = (SELECT MAX(rd_expense) FROM Financial); 

-- Question 18. What was the average number of COVID-19 daily new cases in Italy in December of 2021?
--  (impossible to compute the number of daily cases in a certain month)
        
        SELECT AVG(new_case) AS 'Average number of daily new cases'
        FROM Covid
        WHERE MONTH(record_date) = 12 AND YEAR(record_date) = 2021
              AND country LIKE '%Italy%';

-- Question 19. How many Netflix TVShows were added to NETFLIX in a month that had maximum deaths per million due to COVID-19 in 2020, South Korea? 

        -- first find out month that South Korea had max deaths in 2020 
        -- what if multiple months? -> distinct 
        WITH Max_Deaths AS (
                SELECT DISTINCT MONTH(record_date) AS record_month, new_deaths_per_million 
                FROM Covid 
                WHERE country LIKE '%South Korea%' AND new_deaths_per_million = 
                                                (SELECT MAX(new_deaths_per_million) 
                                                FROM Covid 
                                                WHERE country LIKE '%South Korea%' AND YEAR(record_date) = '2020') 
                                                AND YEAR(record_date) = '2020'
                                                )
        SELECT COUNT(show_id) AS 'Number of TV Shows', type, released_country, new_deaths_per_million, MONTH(Content.date_added) AS 'Month added to Netflix'
        FROM Content, Max_Deaths 
        WHERE type LIKE '%TV SHOW%' AND Content.released_country LIKE '%South Korea%' AND YEAR(Content.date_added) = '2020' AND MONTH(Content.date_added) = record_month
        GROUP BY MONTH(Content.date_added)
        ORDER BY COUNT(show_id) DESC;
        

-- Question 20. What is the title of a Netflix movie with the shortest duration that was added to Netflix when 
-- COVID-19 daily cases in Japan was over 10,000? 

        DROP VIEW IF EXISTS MINUTE; 
        CREATE VIEW MINUTE AS 
        (SELECT title, type, date_added, CAST(REPLACE(Content.duration, 'min', '') AS INT) as duration 
        From Content
        WHERE type LIKE '%Movie%');
        
        WITH Covid_record AS (
                SELECT DISTINCT record_date
                FROM Covid
                WHERE new_case > 10000 AND country LIKE '%Japan%'
                )
        
        SELECT title, date_added
        FROM MINUTE, Covid_record
        WHERE duration = (SELECT MIN(duration) FROM MINUTE WHERE type LIKE '%Movie%' AND MINUTE.date_added = Covid_record.record_date)
              AND MINUTE.date_added = Covid_record.record_date;
        