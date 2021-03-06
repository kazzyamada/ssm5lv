<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::resource("tasks","TaskController"); // Add this line in routes.php
Route::resource("entries","EntryController"); // Add this line in routes.php
Route::resource("days","DayController"); // Add this line in routes.php
Route::get('tasks/{id}/copy', 'TaskController@copy')->name('tasks.copy');
Route::get('total', 'TaskController@total')->name('tasks.total');


Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController'); // for User CRUD


// for simple api test
Route::get('api/echo', "AppController@echo1");

