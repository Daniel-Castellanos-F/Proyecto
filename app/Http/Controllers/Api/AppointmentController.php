<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\StoreAppointment;

class AppointmentController extends Controller
{
	/*
		"id",
        "escenario_id",
        "user_id",
        "schedule_date",
        "schedule_time",
        "motivo",
        "created_at",
        "updated_at",
        "status",
	*/

    public function index()
    {
    	$user = Auth::guard('api')->user();
    	$appointments = $user->asUsuarioAppointments()
	    	->with([
	    		'escenario' =>function ($query){
	    			$query->select('id', 'name', 'description', 'address');

	    		}
	    	])
	    	->get([

	    		"id",
		        "escenario_id",
		        "schedule_date",
		        "schedule_time",
		        "motivo",
		        "created_at",
		        "status",
	    	]);

    	return $appointments;
    }

    public function store(StoreAppointment $request)
    {
    	$success = Appointment::createForUsuario($request, auth()->id());
    	return compact('success');

    }
}

