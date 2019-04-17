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

	Route::get('/users/teachers','UsersController@teachers')->name('users.teachers');
	Route::post('/users/new/teacher','UsersController@new_teacher')->name('users.new.teacher');

	Route::get('/users/students','UsersController@students')->name('users.students');
	Route::post('/users/new/student','UsersController@new_student')->name('users.new.student');

});
