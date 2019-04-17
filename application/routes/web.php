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

Route::group(['prefix' => 'admin'], function(){

	Route::resource('lessons','LessonsController');
	Route::resource('calendars','CalendarsController');
	Route::resource('credits','CreditsController');
	Route::resource('users','UsersController');

	Route::get('/profile','UsersController@profile')->name('users.profile');

	Route::get('/teachers','TeachersController@index')->name('teachers.index');
	Route::get('/teachers/new','TeachersController@create')->name('teachers.create');

	Route::get('/students','StudentsController@index')->name('students.index');
	Route::get('/students/new','StudentsController@create')->name('students.create');


});
