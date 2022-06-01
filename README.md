# Database Project Spring 2022

## You can access our project using this link: https://ugrad.cs.jhu.edu/~yshin31/yshin31_klim30/public_html/yshin31_klim30.html


### Partners 
- Yewon Shin (yshin31) 
- Kyoungjin Lim(klim30) 

### Domain
As for the domain of our project, the topics of our interests included video production in the streaming services industry, financial statements, and Covid-19. We chose Netflix as the representative streaming and production services company. We have found these three databases online for our project:  Netflix dataset has Netflix contents data that includes unique id, type, title, Release year, country, date added to Netflix, rating, and duration. The Netflix financial dataset has fields related to the financial status of Netflix, such as net income, revenue, earnings per share, and gross profit, on a quarterly basis. The worldwide COVID-19 dataset has various fields regarding COVID-19, such as newly confirmed cases, the number of deaths related to COVID-19, in a daily interval for most country in the world.

### Purpose
The purpose of our database was to find the relationship between covid/netflix revenue/netflix production. Before looking into the results of our written queries, we hypothesized that Netflix benefited from the pandemic. This thought was based on the fact that people had to do social distancing and spend more time in indoor activities which include watching TV shows/movies.

### Conclusion
Netflix revenue kept increasing from 2020-2022, so we thought the number of new shows and movies would also have increased. However, Netflix’s content production had no significant change in amount. Instead, we noticed a significant increase in revenue. We think this is possibly due to the increased number of Netflix subscribers or increased screentime. There were up-and-downs in net income but this could be due to the increased R&D expense over time which means Netflix has been investing more and more in content production. As expected, most shows were produced and released in the United States where Netflix is based on. 

### Any changes / issues encountered 
#### 1. txt file formatting using ; for netflix data
Within the ‘title’ column of netflix, there were some content names that include ‘,’. We were using ‘,’ to separate data fields in our txt files, so when initiating it as a table on the database, data was not inserted properly. Instead of ‘,’, we decided to use ‘;’ to separate data fields. 
#### 2. primary key changed for covid data 
In Phase B, we have indicated ‘Date’ as a primary key for Covid-19 data. However, when setting up the database for this phase, we have noticed that ‘Date’ can’t be a unique datafield. Different countries may have Covid data recorded on the same date, so this field cannot be used as a primary key. To solve this issue, we decided to create an additional column called ‘record_id’ (char data type). This column is made by merging date and country name, so it can uniquely define each covid-19 record. 
Due to this change, we had some modification on our ER diagram. Also, when creating tables on the database, we renamed our table names so that it’s more convenient for us to do queries in the future. 
- Covid: data table with covd-19 related data 
- Content: data table with content information on Netflix 
- Financial: data table with Netflix Quarterly Income Statement 
- Influenced_by: data table relating Covd & Content 
- * Note: when creating a table for netflix data, we named the table as Content instead of Netflix so it corresponds to our ER diagram

#### 3. Influenced_by relation 
From our ER diagram, two entities are in a strong-entity relation: Content and Covid. Besides three entities, we have also initiated a table called ‘Influenced_by’ relation as well. Instead of creating it directly from a .sql file, we created a separate ‘influenced_by’ txt just as we did for the three other entities. Here are the steps: 
the big idea here is that we merged two (Content, Covid) csv files in the preprocessing stage (cross join Content, Covid on two matching datafields): 
Covid record’s country equals Content’s released country 
Covid’s record year matches Content’s date added year 
using Python Pandas, we renamed columns ‘date_added’ and ‘released_country’ from Content csv file into ‘date’ and ‘country’ 
Renamed columns ‘record_date’ into ‘date’ from Covid csv file 
Created a new column called ‘Year’ for each csv file by extracting year from ‘date_added’ for Netflix data and ‘record_data’ for Covid data 
Merged to csv files on matching country & year columns 
Turned merged csv file into a txt file with two fields: show_id, record_id 
Created table called ‘Influneced_by’ on database using the above txt file
