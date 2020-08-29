<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
    	'escenario_id',
    	'user_id',
    	'schedule_date',
    	'schedule_time'

    ];

    //acceder desde un appointment a un escenario
    public function escenario(){
    	return $this->belongsTo(Escenario::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cancellation()
    {
        return $this->hasOne(CancellAppointment::class);

    }

    //acceso para convertir formato de horas (12) dentro del apppointment
    public function getScheduleTime12Attribute(){
    	return (new Carbon($this->schedule_time))
			->format('g:i A');
    }

}
