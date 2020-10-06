<?php


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

   	//Fcm
   	Route::post('/fcm/send', 'FirebaseController@sendAll');

   	//reports
   	Route::get('/charts/appointments/line','ChartController@appointments');
   	Route::get('/charts/escenarios/column','ChartController@escenarios');
   	Route::get('/charts/escenarios/column/data','ChartController@escenariosJson');
   
});
Route::middleware('auth')->group(function() {
	Route::get('/appointments/create','AppointmentController@create');
	Route::post('/appointments','AppointmentController@store');
	Route::get('/appointments','AppointmentController@index');

	Route::get('/appointments/{appointment}','AppointmentController@show');

	Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
	Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

	Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');
	Route::post('/appointments/{appointment}/attended', 'AppointmentController@attended');

	

});

