<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Escenario;
use App\Appointment;
use App\CancellAppointment;
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
     
    public function store(Request $request, ScheduleServiceInterface $scheduleService)
    {
    	$rules =[
    		'escenario_id' => 'exists:escenarios,id',
    		'schedule_time' => 'required',
            'motivo' => 'required'
    	];
    	$messages =[
    		'schedule_time.required' => 'Por favor seleccione una hora valida para la reserva.'
    	];


    	$validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function($validator) use ($request, $scheduleService){
            
            $date = $request->input('schedule_date');
            $escenarioId = $request->input('escenario_id'); 
            $schedule_time = $request->input('schedule_time'); 

            if($date && $escenarioId && $schedule_time){
                    $start = new Carbon($schedule_time);
            }else{
                return;
            }

            if(!$scheduleService->isAvailableInterval($date, $escenarioId, $start)){
                $validator->errors()->add('available_time', 'La Hora ya se enceuntra reservada.');
            }

        });



        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }


    	$data = $request->only([	
    		'escenario_id',
    		'schedule_date',
    		'schedule_time',
            'motivo'
    	]);
    	$data['user_id'] = auth()->id();
    	$carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']);
		$data['schedule_time'] = $carbonTime->format('H:i:s');
		Appointment::create($data);

    	$notification  = 'La reserva se registro correctamente!';
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
