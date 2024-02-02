<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//eeasasd

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('admin', ['middleware' => 'auth', function () use ($router) {
    return $router->app->version();
}]);

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'show-time'], function () use ($router) {
        $router->get('/', 'ShowTimeController@index');
        $router->post('/create', 'ShowTimeController@store');
        $router->put('/update/{id}', 'ShowTimeController@update');
        $router->delete('/delete/{id}', 'ShowTimeController@destroy');
    });

    $router->get('/ct', 'MoviesController@detail_index');
    $router->get('/ct/{id}', 'MoviesController@detail');
    $router->post('/ct', 'MoviesController@create_detail');
    $router->put('/ct/{id}', 'MoviesController@update_detail');
    $router->delete('/ct/{id}', 'MoviesController@delete_detail');

    $router->group(['prefix' => 'ticket'], function () use ($router) {
        $router->get('/', 'TicketController@index');
        $router->post('/create', 'TicketController@store');
        $router->put('/update/{id}', 'TicketController@update');
        $router->delete('/delete/{id}', 'TicketController@destroy');
    });
    
    $router->group(['prefix' => 'booking-history'], function () use ($router) {
        $router->get('/', 'BookingController@index');
        $router->post('/create', 'BookingController@store');
        $router->patch('/edit/{bookingID}', 'BookingController@update');
        $router->delete('/delete/{bookingID}', 'BookingController@destroy');
    });

});

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@lregister');
