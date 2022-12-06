# SIDES GmbH Task

Note - please do not hesitate to contact me in case if there would be any questions.

## How to set up
  1. Download the project
  2. Open the root file of php project
  3. Open the terminal in this file and type `$ php -S localhost:8000 -t public/`
  4. Install dependencies, run `$ composer install`
  5. Upload `.sql` file into your database;
  
## Endpoints

### Pizza Endpoints (Auth Needed)

`http://localhost:8000/pizza` **[GET]** returns all pizza that belongs to concrete users

`http://localhost:8000/pizza/{id}` **[GET]** returns concrete pizza

`http://localhost:8000/pizza/create` **[POST]** creates pizza [Parameters: 'name' => 'required', 'pizza_type_id'=> 'required|numeric', 'quantity' => 'required|numeric|min:1']

`http://localhost:8000/pizza/update/{id}` **[POST]** updates pizza [Parameters: 'name' => 'max:200', 'pizza_type_id'=> 'numeric', 'quantity' => 'numeric|min:1']

`http://localhost:8000/pizza/delete/{id}` **[DELETE]** delete pizza

### Pizza Type Endpoints (No Auth)

`http://localhost:8000/type` **[GET]** returns all pizza type

`http://localhost:8000/type/{id}` **[GET]** returns concrete pizza

`http://localhost:8000/type/create` **[POST]** creates pizza type [Parameters 'name' => 'required|min:1' ]

## Auth User
  - In order to auth your user, copy token placed in folder "token.txt"
  - Past the token into HEADER, name it "Authorization" during the request. `Authorization = [JWT KEY]`
