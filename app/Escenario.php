<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{
   public function asEscenarioAppointments()
   {
   		return $this->hasMany(Appointment::class, 'escenario_id');
   }
   public function attendedAppointments()
   {
   		return $this->asEscenarioAppointments()->where('status', 'Atendida');
   }
   public function cancelledAppointments()
   {
   		return $this->asEscenarioAppointments()->where('status', 'Cancelada');
   }
}
