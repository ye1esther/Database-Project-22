# Spring-22-Database-Project


### partners 
- Yewon Shin (yshin31) 
- Kyoungjin Lim(klim30) 


## List any changes / issues encountered 
#### txt file formatting using ; for netflix data
- Within the ‘title’ column of netflix, there were some content names that include ‘,’. We were using ‘,’ to separate data fields in our txt files, so when initiating it as a table on the database, data was not inserted properly. Instead of ‘,’, we decided to use ‘;’ to separate data fields. 
#### primary key changed for covid data 
- In Phase B, we have indicated ‘Date’ as a primary key for Covid-19 data. However, when setting up the database for this phase, we have noticed that ‘Date’ can’t be a unique field. Different countries may have Covid data recorded on the same date, so this field cannot be used as a primary key. To solve this issue, we decided to create an additional column called ‘record_id’ (char data type). This column is made by merging date and country name, so it can uniquely define each record. 
- Due to this change, we had some modification on our ER diagram. Also, when creating tables on the database, we renamed our table names so that it’s more convenient for us to do queries in the future. 
#### Influenced_by relation 
From our ER diagram, two entities are in a strong-entity relation: Content and Covid. Besides three entities, we have also initiated a table called ‘Influenced_by’ relation as well. Instead of creating it directly from a .sql file, we created a separate ‘influenced_by’ txt just as we did for the three other entities. Here are the steps: 
-the big idea here is that we merged two data (Content, Covid) csv files in the preprocessing stage (cross join Content, Covid on two matching relationships: 
  - Covid record country equals Content released country 
  - Covid record year matches Content date added year 
  - using Python Pandas, we renamed columns date_added and released_country from Content csv file into ‘date’ and ‘country’ 
  - Renamed columns ‘record_date’ into ‘date’ from Covid csv file 
  - Created new column called ‘Year’ for each csv file by extracting year from ‘date_added’ for Netflix data and ‘record_data’ for Covid data 
  - Merged to csv files on matching country & year columns 
  - Turned merged csv file into a txt file with two fields: show_id, record_id 
  - Created table called ‘Influneced_by’ on database using the above txt file 
