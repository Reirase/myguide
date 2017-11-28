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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MainController@index');
Route::get('/add', 'wisataController@newProduct');
Route::get('/home', 'wisataController@index');
Route::get('/destroy/{id}', 'wisataController@destroy');
Route::post('/save', 'wisataController@add');
Route::get('wisata/{id}', 'wisataController@show');

