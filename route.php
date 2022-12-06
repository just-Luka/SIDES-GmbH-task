<?php

namespace App;


use App\domain\AuthToken;
use Bramus\Router\Router;

$router = new Router();

// Auth Middleware, if code becomes too big in here, use Chain of responsibility
$router->before('GET|POST|DELETE', '/pizza.*', function (){
    $auth = (new AuthToken())->decode(isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null);
    if (!$auth){
        exit();
    }
});

// Pizza
$router->get('/pizza(/\w+)?', 'App\data\controllers\PizzaController@read');
$router->post('/pizza/create', 'App\data\controllers\PizzaController@create');
$router->post('/pizza/update/(\w+)', 'App\data\controllers\PizzaController@update');
$router->delete('/pizza/delete/(\w+)', 'App\data\controllers\PizzaController@delete');

// Pizza Types
$router->get('/type(/\w+)?', 'App\data\controllers\PizzaTypeController@read');
$router->post('/type/create', 'App\data\controllers\PizzaTypeController@create');

$router->run();
