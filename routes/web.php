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

// user profile
Route::get('/profile', 'ProfileController@index')->middleware('auth')->name('profile');
Route::post('/profile/remove', 'ProfileController@deleteProfile')->middleware('auth')->name('deleteProfile');

// teams
Route::get('/teams', 'TeamsController@index')->middleware('auth')->name('teams');
Route::get('/teams/add', 'TeamsController@addIndex')->middleware('auth')->name('addTeam');
Route::post('/teams/add', 'TeamsController@createTeam')->middleware('auth')->name('createTeam');
Route::post('/teams/remove', 'TeamsController@removeTeam')->middleware('auth')->name('removeTeam');

// admin stuff
Route::get('/admin', 'AdminController@index')->middleware('is_admin')->name('admin');
Route::post('/admin/removeTeam', 'AdminController@removeTeam')->middleware('is_admin')->name('removeTeamAdmin');
Route::get('/admin/overview', 'AdminController@overview')->middleware('is_admin')->name('overview');
Route::get('/admin/user/{id}', 'AdminController@userDetail')->middleware('is_admin')->name('userDetail');
Route::get('/admin/teams/add/{id}', 'AdminController@addTeam')->middleware('is_admin')->name('addTeamAdmin');
Route::post('/admin/teams/add', 'AdminController@createTeam')->middleware('is_admin')->name('createTeamAdmin');
Route::post('/admin/user/delete', 'AdminController@deleteUser')->middleware('is_admin')->name('deleteUser');
Route::get('/admin/overview/databasedumpuses', 'AdminController@databaseDumpUsers')->middleware('is_admin')->name('databaseDumpUsers');
Route::get('/admin/overview/databasedumpteams', 'AdminController@databaseDumpTeams')->middleware('is_admin')->name('databaseDumpTeams');

// logging
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('is_admin')->name('logViewer');

// Localization
Route::get('/js/lang.js', function () {
    // $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');

        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            foreach (require $file as $key => $term) {
                $name = basename($file, '.php');
                $strings[$name.'.'.$key] = $term;
            }
        }

        // return $strings;
    // });

    header('Content-Type: text/javascript');
    echo ('{window.localization = window.localization || {};'
    .'const localization = ' . json_encode($strings) . ';'
    .'let key;'
    .'for (key in localization) window.localization[key] = localization[key];};');
    exit();
})->name('assets.lang');


