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
Route::get('/management', 'RegisterManagementController@index');
Route::post('/management/indexToMonthly', 'RegisterManagementController@indexToMonthly');
Route::get('/management/create', 'RegisterManagementController@create');
Route::post('/management', 'RegisterManagementController@store');
Route::get('/management/edit/{id}', 'RegisterManagementController@edit');
Route::post('/management/update', 'RegisterManagementController@update');
Route::get('/management/{id}/conform', 'RegisterManagementController@conform');
Route::post('/management/delete', 'RegisterManagementController@delete');
Route::post('/management/lodging', 'RegisterManagementController@lodging');
Route::get('/management/schedule', 'RegisterManagementController@schedule');
Route::post('/management/schedule', 'RegisterManagementController@scheduleToMonthly');
Route::get('/management/total', 'RegisterManagementController@total');
Route::post('/management/total', 'RegisterManagementController@totalToMonthly');
Route::get('/management/checkout', 'RegisterManagementController@checkout');

Route::get('/room', 'RoomController@index');
Route::get('/room/create', 'RoomController@create');
Route::post('/room', 'RoomController@store');
Route::get('/room/{id}/edit', 'RoomController@edit');
Route::post('/room/update', 'RoomController@update');
Route::get('/room/{id}/conform', 'RoomController@conform');
Route::post('/room/delete', 'RoomController@delete');

Route::post('/api/rooms', 'ApiController@rooms');
Route::post('/api/update', 'ApiController@update');
Route::post('/api/delete', 'ApiController@delete');
Route::post('/api/registers', 'ApiController@registers');
Route::post('/api/timelist', 'ApiController@timelist');
