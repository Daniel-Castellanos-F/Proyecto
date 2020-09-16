<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Escenario;
use App\Appointment;
use App\CancellAppointment;
use App\Http\Requests\StoreAppointment;
use Carbon\Carbon;
use Validator;
use App\Interfaces\ScheduleServiceInterface;


class AppointmentController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if($role == 'admin'){
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->paginate(10);
        }
        else {
            $pendingAppointments = Appointment::where('status', 'Reservada')
            ->where('user_id', auth()->id())
            ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('user_id', auth()->id())
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('user_id', auth()->id())
                ->paginate(10);
        }
       

        return view('appointments.index',compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments', 'role' ));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment','role'));
    }
    public function create(ScheduleServiceInterface $scheduleService)
    {
    	$escenarios = Escenario::all();
    	
        $date = old('schedule_date');
        $escenarioId = old('escenario_id');
        if($date && $escenarioId){
            $intervals = $scheduleService->getAvailableIntervals($date, $escenarioId);
        } else {
            $intervals = null;
        }

        return view('appointments.create',compact('escenarios','intervals'));
    }
     
    public function store(StoreAppointment $request)
    {
    			
        $created = Appointment::createForUsuario($request, auth()->id());

        if ($created)
            $notification  = 'La reserva se registro correctamente!'; 
        else
            $notification  = 'Ocurrio un problema al registrar la reserva!';
    	
        return back()->with(compact('notification'));
    }

    public function showCancelForm(Appointment $appointment)
    {
        if($appointment->status == 'Confirmada'){
            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment', 'role'));
        }
            
        return redirect('/appointments');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if($request->has('justification')){
            $cancellation = new CancellAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Cancelada';
        $appointment->save();

        $notification = 'La reserva se ha cancelado correctamenta';
        return redirect('/appointments')->with(compact('notification'));
    }	

    public function postConfirm(Appointment $appointment)
    {
        $appointment->status = 'Confirmada';
        $appointment->save();

        $notification = 'La reserva se ha Confirmada correctamenta';
        return redirect('/appointments')->with(compact('notification'));
    }
}
