/*
Members: 
Yewon Shin (yshin31) 
Kyoungjin Lim (klim30)
*/ 

DROP TABLE IF EXISTS Covid; 
DROP TABLE IF EXISTS Financial; 
DROP TABLE IF EXISTS Content; 
DROP TABLE IF EXISTS Influenced_by; 


CREATE TABLE Covid ( 

  country VARCHAR(30), 
  record_date DATETIME, 
  total_case INT, 
  new_case INT, 
  new_deaths_per_million Decimal(5,2), 
  record_id VARCHAR(50) not null, 
  PRIMARY KEY (record_id)
  
); 

CREATE TABLE Financial ( 
     filing_quarter_id DATETIME not null, 
     revenue  Decimal(10,2), 
     rd_expense Decimal(10,2), 
     net_income Decimal(10,2), 
     earnings_per_share Decimal(10,4), 
     PRIMARY KEY (filing_quarter_id) 
);



CREATE TABLE Content (
  show_id            VARCHAR(10),
  type               VARCHAR(10),
  title              VARCHAR(100),
  released_country   VARCHAR(30),
  date_added         DATETIME,
  release_year       INT,
  rating             VARCHAR(20),
  duration           VARCHAR(20),
  PRIMARY KEY(show_id)
);

Create Table Influenced_by (
  show_id   VARCHAR(10),
  record_id VARCHAR(50) NOT NULL
);
  

LOAD DATA LOCAL INFILE 
 './quarterly_income_statement.txt' 
        into table Financial fields terminated by ',';
 
LOAD DATA LOCAL INFILE 
  './covid.txt' 
        into table Covid fields terminated by ',' ;
        
        
LOAD DATA LOCAL INFILE 
 './netflix.txt' 
        into table Content fields terminated by ';';
        
        
LOAD DATA LOCAL INFILE 
 './influenced_by.txt' 
        into table Influenced_by fields terminated by ',';