import pandas as pd 
import csv 
import os 

# export csv into txt file 
financial = pd.read_csv(os.path.join(os.path.dirname(__file__), "../financial/Quarterly_Income_Statement.csv"))


financial.to_csv('preprocessed_financial.csv', index = False)


with open(r'quarterly_income_statement.txt', "w") as text_output_file: 
    with open(r'preprocessed_financial.csv', "r") as csv_input_file: 
        for row in csv.reader(csv_input_file):
            text_output_file.write(" ".join(row)+'\n')
    text_output_file.close()

