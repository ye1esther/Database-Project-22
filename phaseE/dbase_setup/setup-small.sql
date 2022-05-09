
/*
Members: 
Yewon Shin (yshin31) 
Kyoungjin Lim (klim30)
*/ 



CREATE TABLE Covid_small ( 
  country VARCHAR(30), 
  record_date DATETIME, 
  total_case INT, 
  new_case INT, 
  new_deaths_per_million Decimal(10,2), 
  record_id VARCHAR(50) not null, 
  PRIMARY KEY (record_id)
  
); 

CREATE TABLE Financial_small ( 
     filing_quarter_id DATETIME not null, 
     revenue  Decimal(10,2), 
     rd_expense Decimal(10,2), 
     net_income Decimal(10,2), 
     earnings_per_share Decimal(10,4), 
     PRIMARY KEY (filing_quarter_id) 
);


CREATE TABLE Content_small (
  show_id            VARCHAR(10),
  type               VARCHAR(10),
  title              VARCHAR(30),
  released_country   VARCHAR(30),
  date_added         DATE,
  release_year       INT,
  rating             VARCHAR(20),
  duration           VARCHAR(20),
  PRIMARY KEY(show_id)
);



Create Table Influenced_by_small (
  show_id            VARCHAR(10),
  record_id          VARCHAR(50) not null
); 


        
LOAD DATA LOCAL INFILE 
 './dbase_setup/quarterly_income_statement-small.txt' 
        into table Financial_small fields terminated by ',';
 
LOAD DATA LOCAL INFILE 
  './dbase_setup/covid-small.txt' 
        into table Covid_small fields terminated by ',';
        
        
LOAD DATA LOCAL INFILE 
 './dbase_setup/netflix-small.txt' 
        into table Content_small fields terminated by ',';
        
LOAD DATA LOCAL INFILE 
 './dbase_setup/influenced_by-small.txt'
        into table Influenced_by_small fields terminated by ',';