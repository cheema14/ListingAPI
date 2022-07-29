# ListingAPI
Fetch records from an API and store it into the database using Core OOP PHP.

I have defined 2 Classes
DataClass - Fetches the data from the URL
StoreClass - Stores the data into the database

I have used curl and after fetching the initial records, I tried to loop through the data until next_page_url key returns a null value.
By the above way, all data would be fetched into my all_data_arr.

After fetching the data, I will store it into the DB. 


A third class will extend DataClass and from there I will call the relevant functions to get the data. Then I will create an object of StoreClass and store the data into the DB.
