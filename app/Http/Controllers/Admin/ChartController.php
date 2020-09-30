<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Escenario;
use DB;

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
    	return view('charts.escenarios');

    }

    public function escenariosJson()
    {
    	$escenario = Escenario::all()
    		->withCount('asEscenarioAppointments')
    		->get()->toArray();
    	dd($escenario);

    	$data = [];
    	$data['categoties'] = Escenario::all(['name']);

    	$series = [];
    	$series1 = 1; //atendidas
    	$series2 = 2; //Canceladas
    	$series[] = $series1;
    	$series[] = $series2;
    	$data['series']= $series;

    	return $data;

    }
}
