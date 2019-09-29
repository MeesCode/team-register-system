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
})->name('home');

Auth::routes();

Route::get('/profile', 'ProfileController@index')->middleware('auth');

Route::get('/teams', 'TeamsController@index')->middleware('auth')->name('teams');
Route::get('/teams/add', 'TeamsController@addIndex')->middleware('auth')->name('addTeam');
Route::post('/teams/add', 'TeamsController@createTeam')->middleware('auth')->name('createTeam');
Route::post('/teams/remove', 'TeamsController@removeTeam')->middleware('auth')->name('removeTeam');

Route::get('/admin', 'AdminController@index')->middleware('is_admin')->name('admin');
Route::post('/admin/removeTeam', 'AdminController@removeTeam')->middleware('is_admin')->name('removeTeamAdmin');
Route::get('/overview', 'AdminController@overview')->middleware('is_admin')->name('overview');
Route::get('/user/{id}', 'AdminController@userDetail')->middleware('is_admin')->name('userDetail');

