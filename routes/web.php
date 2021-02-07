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

Route::get('/', function () {
    return view('home');
})->middleware('auth');







Route::resource('/usermanager','UsermanagerController')->middleware('auth');

Route::resource('/expense-cat','CatmanController');
Route::resource('/expense','expenseController');
Route::resource('/role','roleController');

Route::get('/','chartController@index')->middleware('auth');

Auth::routes();

Route::get('/charts', 'ChartController@xchart');
Route::get('/list', 'ChartController@xlist');



Route::delete('/usermanager', 'UsermanagerController@destroy');
Route::put('/usermanager', 'UsermanagerController@update');

Route::delete('/role', 'roleController@destroy');
Route::put('/role', 'roleController@update');

Route::delete('/expense-cat', 'CatmanController@destroy');
Route::put('/expense-cat', 'CatmanController@update');

Route::delete('/expense', 'expenseController@destroy');
Route::put('/expense', 'expenseController@update');