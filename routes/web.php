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

Route::get('/overview', 'OverviewController@index')->middleware('auth')->name('overview');
Route::get('/profile', 'ProfileController@index')->middleware('auth');

Route::get('/teams', 'TeamsController@index')->middleware('auth')->name('teams');
Route::get('/teams/add', 'TeamsController@addIndex')->middleware('auth')->name('addTeam');
Route::post('/teams/add', 'TeamsController@createTeam')->middleware('auth')->name('createTeam');

Route::get('/admin', 'AdminController@index')->middleware('is_admin')->name('admin');

