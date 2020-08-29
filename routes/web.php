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
    //return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function() {

	//Escenarios
	Route::get('/Escenarios', 'EscenarioController@index');
	Route::get('/Escenarios/create', 'EscenarioController@create'); // form registro
	Route::get('/Escenarios/{escenario}/edit', 'EscenarioController@edit'); 

	Route::post('/Escenarios', 'EscenarioController@store'); // envio del form
	Route::put('/Escenarios/{escenario}', 'EscenarioController@update'); 
	Route::delete('/Escenarios/{escenario}', 'EscenarioController@destroy'); 
	//Instructor
	Route::resource('instructores','InstructorController');
	//Usuario
	Route::resource('usuarios','UsuarioController');
	//Horarios
	Route::get('/schedule', 'ScheduleController@edit');
	Route::post('/schedule', 'ScheduleController@store');

});
Route::middleware('auth')->group(function() {
	Route::get('/appointments/create','AppointmentController@create');
	Route::post('/appointments','AppointmentController@store');
	Route::get('/appointments','AppointmentController@index');

	Route::get('/appointments/{appointment}','AppointmentController@show');

	Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
	Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

	Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');




	// JSON
	Route::get('/schedule/hours','Api\ScheduleController@hours');

});

