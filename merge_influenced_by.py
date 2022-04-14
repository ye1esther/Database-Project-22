import pandas as pd 
import os
import csv 

content = pd.read_csv(os.path.join(os.path.dirname(__file__), "netflix/preprocessed_netflix.csv"))
covid = pd.read_csv(os.path.join(os.path.dirname(__file__), "covid/preprocessed_covid.csv"))

#rename common columns 
content.rename(columns={'released_country':'country'},inplace=True)
content['year'] = pd.DatetimeIndex(content['date_added']).year
covid['year'] = pd.DatetimeIndex(covid['record_date']).year

merged= content.merge(covid, on=['country','year'],how='outer')

# Defines a list that contains the names of all the columns we want to drop.
to_drop = ['type','title','country','date_added','release_year','rating','duration','year','total_case','new_case','new_deaths_per_million', 'record_date']

# Removes the columns included in the to_drop list
merged.drop(to_drop, axis = 1, inplace = True)

# remove null rows 
merged.dropna(inplace=True)

merged.to_csv("preprocessed_influenced_by.csv", index=False)

csv_file = r'preprocessed_influenced_by.csv'
txt_file = r'influenced_by.txt'
with open(txt_file, "w") as my_output_file:
    with open(csv_file, "r") as my_input_file:
        reader = csv.reader(my_input_file)
        next(reader)
        [my_output_file.write(", ".join(row)+'\n') for row in reader]
        my_output_file.close()