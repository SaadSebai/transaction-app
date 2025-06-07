# Transaction App

A custom PHP MVC app with authentication for administrators to manage clients, record earnings/expenses, and generate reports with filters.

## Features

- Administrator login
- CRUD for clients
- Track client earnings/expenses
- View reports by date range
- Simple REST API for client transactions

## Tech Stack

- PHP (custom MVC)
- MySQL
- JavaScript

## Getting Started

Use the following commands to prepare the project

- installing composer: 
```bash
  composer i
```

- Create my sql database named ```ta_db``` or change the name and credentials in ```config/database.php``` then run
the following command to create the tables and create a default admin ```admin@test.com``` with password ```password```:
```bash
  php database/migration.php
```

- Then run the app in your local:
```bash
  php -S localhost:8000 -t public
```

## Additional Info

### Life Cycle

The app life cycle starts with ```index.php```, you will find a call to multiple php files
- ```vendor/autoload.php```
- ```app/Core/Helpers/functions.php```: Contains helper functions that I used through the app.
- ```bootstrap.php```: Start the service container and fill it with the necessary objects.
- ```app/Core/header.php```: Add additional security layers.

Next, We will use the router object to manage our routes, then we call ```routes.php``` you can find the routes in this file.
You will find the routes being called in this way

```php
$router->method('/my-route', MyController::class, 'controllerMethod')->middleware(['my-middleware']);
```

- ```method```: ```get```, ```post```, ```put```, ```patch```, ```delete```.
- ```/my-route```: The route your redirecting to.
- ```MyController::class```: The controller class.
- ```controllerMethod```: The method in the controller (example: ```index```, ```create```, ```store```...).
- ```my-middleware```: The name of the middleware, you can find the registered route middlewares in ```config/middlewares.php```
specifically in the ```route``` key. the middlewares in the ```global``` key are used automatically.
- Uri's parameters will be passed in the controller's method.

After that, we will move to the controller to handle our request, validating it if needed using a class from one of the classes in
```app/Http/Requests```, this class extends from ```app/Core/FormRequest``` that have the validation process method,
you just need declare ```rules()``` method that contains the parameters names and the rules using ```App\Core\Validator```.

Then, We use Service classes to write our logic and Repository classes to manage our database query.
Here is a breakdown on how Repositories works:

- The called Repository class: define the query logic.
- ```App\Repositories\Repository```: extended by Repositories, it manages the database by calling the ```App\Core\Database```,
and convert the records to Models.
- ```App\Core\Database```: Stored in the service container, it deals with the PDO class and create the connection with the Database.

The Response will depend on the controller:

- Views: Calling a view using ```view``` function in the ```app/Core/Helpers/functions.php```, it can accept the name of the view,
the attributes and the layout
- API Response: in ```app/Http/ApiResponse``` you can find classes that manage the response through ```toArray()``` method
calling ```App\Core\ApiResource``` that contains the logic that convert the data to json.
- Redirecting: Another helper function that redirect the user to a different route.

The last thing we need to talk about in the life cycle is the session, in the ```index.php``` we start the session, so we can use it through
the app. for example in case we had a validation error we set it in the ```_flash``` key with the old values, 
at the end of the cycle we remove the ```_flash```.

### Auth

We also used the Session in managing the Auth of the admin, by using the ```App\Core\Helpers\Hash``` in the ```LoginService```,
we can check for the hashed password in the database. For securing the routes, I'm using ```auth``` middleware 
(and the ```guest``` middleware for the routes that should not be seen by auth user like login).

The admin record is created in the ```database/seeders/admin_seeder.php```, we will talk about seeders later.

### Migrations and Seeders

The ```database/migration.php``` migrates the DB and creates default data:

- Migrations: Founded in ```database/migrations```, it's basically Sql that will create or update the database's tables,
any file added to this folder will be automatically run in ```database/migration.php```.
- Seeders: As discussed in previously, seeders contains the default values that we want to start our app with, 
all files in the ```database/seeders``` will be automatically run like the migrations.