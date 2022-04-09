import pandas as pd 
import os


covid = pd.read_csv(os.path.join(os.path.dirname(__file__), "../dataset/owid-covid-latest.csv"))




print(covid)