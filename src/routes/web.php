<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::put('todo/show/{id}', 'TodoController@show');
Route::post('todo/create', 'TodoController@create');
Route::get('todo', 'TodoController@read');
Route::put('todo/update/{id}', 'TodoController@update');
Route::delete('todo/delete/{id}', 'TodoController@delete');

Route::put('task/show/{id}', 'TaskController@show');
Route::put('task/update/{id}', 'TaskController@update');
Route::post('task/create', 'TaskController@create');
Route::delete('task/delete/{id}', 'TaskController@delete');
Route::put('task/change_state/{id}', 'TaskController@change_state');
Route::put('task/filter_state/{state}', 'TaskController@filter_state');
Route::put('task/search/{task}', 'TaskController@search');
Route::get('task/newest', 'TaskController@newest');
Route::get('task/timestamp', 'TaskController@timestamp');