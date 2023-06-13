<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Task

To write a test task that should perform shelter management for cats, I wrote an API with which you can use CRUD. To see where these APIs are located, use this path: .\routes\api.

Tests were also written for each of the APIs. Tests can be found by going to: .\tests\Smoke

To validate data we have created Request files behind the path: .\app\Http\Requests\

The models can be found by: .\app\Models

## Cats API

Cats table has the following columns:<br>
id - Cat id.<br>
name - Cat name.<br>
health - Is the cat healthy. Uses "Ok" or "No".<br>
arrival - Date when the cat was delivered to the shelter.<br>
departure - Date when the cat was taken from the shelter.<br>
created_at - The date on which the entry was created. <br>
updated_at - The date on which the entry was updated. <br>

http://127.0.0.1:8000/api/cats - List of all cats

http://127.0.0.1:8000/api/cat/add - Adding cat to the database. To successfully add a cat to the database, it is necessary to use data in Body such as: <br>
name - Thomas <br>
health - Ok <br>
arrival - 2023-06-10 <br>
departure - 2023-06-12 <br>

http://127.0.0.1:8000/api/cat/update - Change of the cat's data in the database. For a successful update it is necessary to use the same data as when adding the new one.

http://127.0.0.1:8000/api/cat/delete - Deleting a cat from the database. To successfully remove a cat from the database, it is necessary to use the same data in Body as: <br>
cat_id (cat ID you want to remove) <br>


## API Shelters
Shelters table has the following columns: <br>
id - Shelters id.<br>
name - Shelter Name <br>
address - Shelter Address <br>
created_at - The date on which the entry was created. <br>
updated_at - The date on which the entry was updated. <br>

http://127.0.0.1:8000/api/shelters - List of all shelters

http://127.0.0.1:8000/api/shelter/add - Add Shelter to database. To add a shelter to the database successfully, it is necessary to use the data in Body such as: <br>
name - Shelters 1 <br>
address - a=Address 1 <br>

http://127.0.0.1:8000/api/shelter/update - Modification of shelter data in the database. For a successful update it is necessary to use the same data as when adding the new one.

http://127.0.0.1:8000/api/shelter/delete - Deleting a shelter from database. For a successful deletion of a shelter from the database you need to use the same data in Body such as: <br>
Shelter_id (the ID of the shelter you want to delete)


## API Employees
The Employees table has the following columns: <br>
id - Employees id.<br>
name - Name of the Employee <br>
Position - Shelter Address <br>
Shelter_id - ID of the shelter where the worker works  <br>
email - employee's email address <br>
birthday - birthday of the employee <br>
created_at - The date on which the entry was created. <br>
updated_at - The date on which the entry was updated. <br>

http://127.0.0.1:8000/api/employees- - list of all employees

http://127.0.0.1:8000/api/employee/add - Adding the worker to the database. For a successful addition of the worker to the database, you need to use in Body such data as: <br>
name - Employee 1 <br>
position - Manager <br>
shelter_id - 1 <br>
email - test@test.com <br>
birthday - 2000-06-12 <br>

http://127.0.0.1:8000/api/employee/update - Modification of employee data in the database. For a successful update it is necessary to use the same data as when adding the new one.

http://127.0.0.1:8000/api/employee/delete - deleting an employee from the database. For the successful deletion of the worker from the database you need to use the same data in Body such as: <br>
employee_id (ID of the employee you want to delete)

