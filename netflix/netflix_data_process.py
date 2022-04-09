import pandas as pd 
import numpy as np 
import os

data_dir = os.getcwd()
netflix_data = 'dataset/netflix_titles.csv'
netflix = pd.read_csv(os.path.normcase(os.path.join(data_dir, netflix_data)))
print(netflix)
#read in netflix data 
##netflix = pd.read_csv(r'C:\Users\kyoungjin\Desktop\database_project\Spring-22-Database-Project\dataset\netflix_titles.csv')

#r'C:\Users\aiLab\Desktop\example.csv'


#print(netflix)
#columns to drop: director, cast 
#to_drop = ['director','cast']
#netflix.dropna(to_drop, how = 'all', inplace=True)

#netflix.to_csv('preprocessed_netflix.csv', index = False) 
