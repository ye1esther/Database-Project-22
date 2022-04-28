
-- Insertions
-- Content Table

   INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
   VALUES ("s8808", "TV Shows", "You", "United States", "2021-10-15 00:00:00", 2021, "TV-MA", "3 seasons");
   
   INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
   VALUES ("s8809", "Movie", "Hairspray", "United States", "2021-10-01 00:00:00", 2007, "PG", "116 min");
   
-- Influenced_by Table

   INSERT INTO Influenced_by
        SELECT Content.show_id, Covid.record_id
        FROM Content, Covid
        WHERE show_id = "s8808" AND Content.released_country = Covid.country;
        
   INSERT INTO Influenced_by
        SELECT Content.show_id, Covid.record_id
        FROM Content, Covid
        WHERE show_id = "s8809" AND Content.released_country = Covid.country;

-- Financial Table 
-- We are adding the most recent financial data reported by Netflix for the first quarter of 2022. 

   INSERT INTO Financial(filing_quarter_id, revenue, rd_expense, net_income, earnings_per_share)
   VALUES ("2022-03-31 00:00:00", 7867.77, 657.53, 1597.45, 3.53);

-- Deletions

   DELETE FROM Covid 
   WHERE Covid.country LIKE "%World%";
   
   
   DELETE FROM Covid 
   WHERE Covid.country LIKE "%Low income%";
   
   
   DELETE FROM Covid 
   WHERE Covid.country LIKE "%High income%";
                    
   DELETE FROM Covid 
   WHERE Covid.country LIKE "%Europe%";  
   
   DELETE FROM Covid 
   WHERE Covid.country LIKE "%Asia%";       
   
   DELETE FROM Covid 
   WHERE Covid.country LIKE "%South America%";   
   
   DELETE FROM Covid 
   WHERE Covid.country LIKE "%North America%";        
   

