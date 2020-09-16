<?php

Route::post('/login', 'AuthController@login');

// JSON public resources
Route::get('/Escenarios', 'EscenarioController@index');
Route::get('/schedule/hours','ScheduleController@hours');
 
Route::middleware('auth:api')->group(function () {

	Route::get('/user', 'UserController@show');
	Route::post('/logout', 'AuthController@logout');

	// post appointments
	Route::post('/appointments', 'AppointmentController@store');

	//appointments
	Route::get('/appointments', 'AppointmentController@index');

});