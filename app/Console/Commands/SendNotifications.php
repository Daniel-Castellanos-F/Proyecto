<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Appointment;

class SendNotifications extends Command
{

    protected $signature = 'fcm:send';
    protected $description = 'Enviar mensaje vía FCM';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        

        $this->info('Buscando reservas confirmadas en las próximas 24 horas.');
        //hora actual
        //2020-09-23 14:00:00
        $now = Carbon::now();

        // schedule_date 2020-09-24
        // schedule_time 15:00:00

        $appointmentsTomorrow = $this->getAppointments24Hours($now);

        foreach ($appointmentsTomorrow as $appointment){
            $appointment->user->sendFCM('No olvides tu reserva mañana a esta hora');
            $this->info('Mensaje FCM enviado 24h antes al usuario (ID):' . $appointment->user_id);
        }

        $appointmentsNextHour = $this->getAppointmentsNextHour($now);

        foreach ($appointmentsNextHour as $appointment){
            $appointment->user->sendFCM('Tienes una reserva en 1 hora. Te esperamos.');
            $this->info('Mensaje FCM enviado faltando 1h antes al usuario (ID):' . $appointment->user_id);
        }
    }

    private function getAppointments24Hours($now)
    {
        return Appointment::where('status', 'Confirmada')
            ->where('schedule_date', $now->addDay()->toDateString())
            ->where('schedule_time', '>=', $now->copy()->subMinutes(3)->toTimeString())
            ->where('schedule_time', '<', $now->copy()->addMinutes(2)->toTimeString())
            ->get(['id', 'schedule_date', 'schedule_time', 'user_id'])->toArray();
    }

    private function getAppointmentsNextHour($now)
    {
        return Appointment::where('status', 'Confirmada')
            ->where('schedule_date', $now->addHour()->toDateString())
            ->where('schedule_time', '>=', $now->copy()->subMinutes(3)->toTimeString())
            ->where('schedule_time', '<', $now->copy()->addMinutes(2)->toTimeString())
            ->get(['id', 'schedule_date', 'schedule_time', 'user_id'])->toArray();
    }
}