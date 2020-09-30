<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{
   public function asEscenarioAppointments()
   {
   		return $this->hasMany(Appointment::class, 'escenario_id');
   }
}
