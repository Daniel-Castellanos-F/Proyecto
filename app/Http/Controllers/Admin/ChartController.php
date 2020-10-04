<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Escenario;
use DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function appointments()
    {
    	$monthlyCounts = Appointment::select(
    			DB::raw('MONTH(created_at) as month'), 
    			DB::raw('COUNT(1) as count')
    		)->groupBy('month')->get()->toArray();

    	$counts = array_fill(0, 12, 0);
    	foreach ($monthlyCounts as $monthlyCount) {
    		$index = $monthlyCount['month']-1;
    		$counts[$index] = $monthlyCount['count'];
    	}

    	//dd($counts);
    	return view('charts.appointments', compact('counts'));
    }

    public function escenarios()
    {
        $now = Carbon::now(); 
        $end = $now->format('Y-m-d');
        $start = $now->subYear()->format('Y-m-d');
    	return view('charts.escenarios', compact('start', 'end'));
    }

    public function escenariosJson(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');

        $escenario = Escenario::select('name')
            ->withCount([
                'attendedAppointments' => function ($query) use ($start, $end){
                    $query->whereBetween('schedule_date', [$start, $end]);
                },
                'cancelledAppointments' => function ($query) use ($start, $end){
                    $query->whereBetween('schedule_date', [$start, $end]);
                }
            ])
            ->orderBy('attended_appointments_count', 'desc')
            ->take(5)
            ->get();

    	$data = [];
    	$data['categories'] = $escenario->pluck('name');

    	$series = [];
        //atendidas
        $series1['name'] = 'Reservas atendidas';
    	$series1['data'] = $escenario->pluck('attended_appointments_count');
        //Canceladas 
        $series2['name'] = 'Reservas canceladas';
    	$series2['data'] = $escenario->pluck('cancelled_appointments_count'); 

    	$series[] = $series1;
    	$series[] = $series2;

    	$data['series']= $series;

    	return $data;

    }
}
