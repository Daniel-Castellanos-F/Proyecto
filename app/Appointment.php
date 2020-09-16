<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Appointment extends Model
{
    protected $fillable = [
    	'escenario_id',
    	'user_id',
        'motivo',
    	'schedule_date',
    	'schedule_time'

    ];

    protected $hidden =[
        'escenario_id', 'schedule_time'
    ];
    protected $appends =[
        'schedule_time_12'
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

    static public function createForUsuario(Request $request, $usuarioId)
    {
        $data = $request->only([    
            'escenario_id',
            'schedule_date',
            'schedule_time',
            'motivo'
        ]);

        $data['user_id'] = $usuarioId;

        $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']);
        $data['schedule_time'] = $carbonTime->format('H:i:s');

        return self::create($data);
    }
}
