<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;

class StoreAppointment extends FormRequest
{
    private $scheduleService;

    public function __construct(ScheduleServiceInterface $scheduleService)
    {
        $this->scheduleService = $scheduleService;

    }
    public function rules()
    {
        return [
            'escenario_id' => 'exists:escenarios,id',
            'schedule_time' => 'required',
            'motivo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'schedule_time.required' => 'Por favor seleccione una hora valida para la reserva.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
             $date = $this->input('schedule_date');
            $escenarioId = $this->input('escenario_id'); 
            $schedule_time = $this->input('schedule_time'); 

            if(!$date || !$escenarioId || !$schedule_time){
                    return;
            }

            $start = new Carbon($schedule_time);

            if(!$this->scheduleService->isAvailableInterval($date, $escenarioId, $start)){
                $validator->errors()->add('available_time', 'La Hora ya se enceuntra reservada.');
            }

        });
    }
}
