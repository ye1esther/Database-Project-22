
-- Insertions

-- Content Table

   INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
   VALUES ("s8808", "TV Shows", "You", "United States", "2021-10-15 00:00:00", 2021, "TV-MA", "3 seasons");
   
   INSERT INTO Content(show_id, type, title, released_country, date_added, release_year, rating, duration)
   VALUES ("s8809", "Movie", "Hairspray", "United States", "2021-10-01 00:00:00", 2007, "PG", "116 min");
   
-- Covid Table

-- Financial Table 
-- We are adding the most recent financial data reported by Netflix for the first quarter of 2022. 

   INSERT INTO Financial(filing_quarter_id, revenue, rd_expense, net_income, earnings_per_share)
   VALUES ("2022-03-31 00:00:00", 7867.77, 657.53, 1597.45, 3.53);

-- Deletions



