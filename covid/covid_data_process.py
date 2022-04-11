import pandas as pd 
import os
import csv 

# covid data url: https://github.com/owid/covid-19-data/blob/master/public/data/latest/owid-covid-latest.csv
covid = pd.read_csv(os.path.join(os.path.dirname(__file__), "../dataset/owid-covid-data.csv"))

# list of columns we want to drop 
to_drop = ['new_deaths','new_cases_per_million','new_deaths_smoothed','iso_code', 'continent', 'new_cases_smoothed', 'total_deaths', 'total_cases_per_million', 'new_cases_smoothed_per_million', 
            'total_deaths_per_million', 'new_deaths_smoothed_per_million', 'reproduction_rate', 'icu_patients', 'icu_patients_per_million',
            'hosp_patients', 'hosp_patients_per_million', 'weekly_icu_admissions', 'weekly_icu_admissions_per_million', 
            'weekly_hosp_admissions', 'weekly_hosp_admissions_per_million', 'total_tests', 	'new_tests', 'total_tests_per_thousand', 
            'new_tests_per_thousand', 'new_tests_smoothed', 'new_tests_smoothed_per_thousand', 'positive_rate', 'tests_per_case',
             'tests_units', 'total_vaccinations', 'people_vaccinated',  'people_fully_vaccinated', 'total_boosters', 
             'new_vaccinations', 'new_vaccinations_smoothed', 'total_vaccinations_per_hundred', 'people_vaccinated_per_hundred', 
             'people_fully_vaccinated_per_hundred', 'total_boosters_per_hundred',  'new_vaccinations_smoothed_per_million', 
             'new_people_vaccinated_smoothed', 'new_people_vaccinated_smoothed_per_hundred', 'stringency_index', 'population', 
             'population_density', 'median_age', 'aged_65_older', 'aged_70_older', 'gdp_per_capita', 'extreme_poverty', 'cardiovasc_death_rate',
             'diabetes_prevalence', 'female_smokers', 'male_smokers', 'handwashing_facilities', 'hospital_beds_per_thousand', 
             'life_expectancy', 'human_development_index', 'excess_mortality_cumulative_absolute', 'excess_mortality_cumulative',
             'excess_mortality', 'excess_mortality_cumulative_per_million']

covid.drop(to_drop, inplace = True, axis=1)

# rename columns 
covid_rename = {'date': 'record_date','location': 'country', 
                'total_cases': 'total_case', 'new_cases': 'new_case',
                'new_deaths_per_million': 'new_deaths_per_million' }
covid.rename(columns=covid_rename, inplace = True)

    


# remove null rows 
covid.dropna(inplace=True)

# store preprocessed data into a new csv file
covid.to_csv('preprocessed_covid.csv', index = False)

# export csv into txt file 
with open(r'covid.txt', "w") as text_output_file: 
    with open(r'preprocessed_covid.csv', "r") as csv_input_file: 
        for row in csv.reader(csv_input_file):
            text_output_file.write(" ".join(row)+'\n')
    text_output_file.close()