import pandas as pd
import os
import csv

netflix = pd.read_csv(os.path.join(os.path.dirname(__file__), "../dataset/netflix_titles.csv"))

# Defines a list that contains the names of all the columns we want to drop.
to_drop = ['director','cast', 'listed_in', 'description']

# Removes the columns included in the to_drop list
netflix.drop(to_drop, axis = 1, inplace = True)

# Renames column 'country' to 'released_country'
netflix.rename(columns={'country': 'released_country'}, inplace=True) 

# Removes the rows that contains NULL values.
netflix.dropna(inplace=True)

# def convert(date):
#     date = datetime.datetime.strptime(date, '%B %d, %Y').strftime('%Y-%m-%d')
#     return;

# series = pd.Series(['20010101', '20010331'])
# >>> dates = pd.to_datetime(series, format='%Y%m%d')
# >>> dates.dt.strftime('%Y-%m-%d')

netflix['date_added'] = netflix['date_added'].str.strip()
dates = pd.to_datetime(netflix['date_added'], format = '%B %d, %Y')
netflix['date_added'] = dates.dt.strftime('%Y-%m-%d')


    # netflix['date_added'] = netflix['date_added'].apply(convert)



# Writes this cleaned data to a new csv file 
netflix.to_csv('preprocessed_netflix.csv', index = False) 


csv_file = r'preprocessed_netflix.csv'
txt_file = r'netflix.txt'
with open(txt_file, "w") as my_output_file:
    with open(csv_file, "r") as my_input_file:
        reader = csv.reader(my_input_file)
        [my_output_file.write(",".join(row)+'\n') for row in reader]
        my_output_file.close()

