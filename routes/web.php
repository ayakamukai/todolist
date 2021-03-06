<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'TodoController@index')->name('index');
Route::post('/store', 'TodoController@store')->name('store');
Route::put('/update/{id}', 'TodoController@update')->name('update');
Route::delete('/delete/{id}', 'TodoController@delete')->name('delete');
Route::put('/doneAll', 'TodoController@doneAll')->name('doneAll');
Route::delete('/deleteAll', 'TodoController@deleteAll')->name('deleteAll');

