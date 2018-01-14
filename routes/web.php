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
    return view('welcome');
});

Route::resource('coins', 'CoinController');

Route::post('/search', 'SearchController@search');
Route::post('/search/square', 'SearchController@square');
Route::get('/map', 'MapController@index');
Route::get('/map/edit', 'MapController@edit');
Route::put('/map', 'MapController@update');
