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
    return redirect("/login");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

	Route::resource('lessons','LessonsController');
	Route::resource('calendars','CalendarsController');

	Route::get('list-calendars','CalendarsController@list_calendars')->name('list.calendars');

	Route::get('repeat-calendar/{id}','CalendarsController@repeat_calendar')->name('repeat.calendar');

	Route::put('end-lesson/{id}','CalendarsController@end_lesson')->name('end.lesson');

	Route::get('my-lessons','CalendarsController@my_lessons')->name('my.lessons');
	Route::get('show-student/{id}','CalendarsController@show_student')->name('show_student');
	Route::put('add-student/{id}','CalendarsController@add_student')->name('add_student');

	Route::resource('credits','CreditsController');
	Route::resource('users','UsersController');

	Route::put('change-password/{id}','UsersController@change_password')->name('change_password');

	Route::get('/profile','UsersController@profile')->name('users.profile');

	Route::get('/teachers','TeachersController@index')->name('teachers.index');
	Route::get('/teachers/new','TeachersController@create')->name('teachers.create');

	Route::get('/hours','TeachersController@hours')->name('hours');

	Route::get('/students','StudentsController@index')->name('students.index');
	Route::get('/students/new','StudentsController@create')->name('students.create');

	Route::get('/administrators','AdministratorsController@index')->name('administrators.index');
	Route::get('/administrators/new','AdministratorsController@create')->name('administrators.create');

});
