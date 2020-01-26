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

// regular auth
Route::group(['middleware' => ['auth']], function () {
    // user profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile/remove', 'ProfileController@deleteProfile')->name('deleteProfile');

    // teams
    Route::get('/teams', 'TeamsController@index')->name('teams');
    Route::get('/teams/add', 'TeamsController@addIndex')->name('addTeam');
    Route::post('/teams/add', 'TeamsController@createTeam')->name('createTeam');
    Route::post('/teams/remove', 'TeamsController@removeTeam')->name('removeTeam');
});

// admin stuff
Route::group(['middleware' => ['is_admin']], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::post('/admin/removeTeam', 'AdminController@removeTeam')->name('removeTeamAdmin');
    Route::get('/admin/overview', 'AdminController@overview')->name('overview');
    Route::get('/admin/user/{id}', 'AdminController@userDetail')->name('userDetail');
    Route::get('/admin/teams/add/{id}', 'AdminController@addTeam')->name('addTeamAdmin');
    Route::post('/admin/teams/add', 'AdminController@createTeam')->name('createTeamAdmin');
    Route::post('/admin/user/delete', 'AdminController@deleteUser')->name('deleteUser');
    Route::get('/admin/overview/databasedumpuses', 'AdminController@databaseDumpUsers')->name('databaseDumpUsers');
    Route::get('/admin/overview/databasedumpteams', 'AdminController@databaseDumpTeams')->name('databaseDumpTeams');
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logViewer');
});


