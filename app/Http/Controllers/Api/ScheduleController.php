<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ScheduleServiceInterface;
use App\WorkDay;
use Carbon\Carbon;


class ScheduleController extends Controller
{
    public function hours(Request $request, ScheduleServiceInterface $scheduleService)
    {
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'escenario_id' => 'required|exists:escenarios,id'
    	];
    	$this->validate($request, $rules);

        $date = $request->input('date');
    	$escenarioId = $request->input('escenario_id');

        return $scheduleService->getAvailableIntervals($date, $escenarioId);
    	
    }
    
}
