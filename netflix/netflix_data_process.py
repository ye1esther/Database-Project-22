import pandas as pd
import os

netflix = pd.read_csv(os.path.join(os.path.dirname(__file__), "../dataset/netflix-titles.csv"))


print(netflix)


# Defines a list that contains the names of all the columns we want to drop.
to_drop = ['director','cast', 'listed_in', 'description']

# Removes the columns included in the to_drop list
netflix.drop(to_drop, axis = 1, inplace = True)

# Removes the rows that contains NULL values.
netflix.dropna()

# Writes this cleaned data to a new csv file 
netflix.to_csv('preprocessed_netflix.csv', index = False) 
