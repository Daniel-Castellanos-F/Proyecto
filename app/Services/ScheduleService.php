<?php namespace App\Services;

use App\WorkDay;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;
use App\Appointment;


class ScheduleService implements ScheduleServiceInterface
{
  	public function isAvailableInterval($date, $escenarioId, Carbon $start){
 
  		// NO exxiste disponibilidad
		$exists = Appointment::where('escenario_id', $escenarioId )
				->where('schedule_date', $date )
				->where('schedule_time', $start->format('H:i:s'))
				->exists();
		return !$exists; // Estara disponbible si no hay fecha reservada
  	}

	public function getAvailableIntervals($date, $escenarioId)
	{
		$workDay = WorkDay::where('active', true)
    	->where('day', $this->getDayFromDate($date))
    	->where('escenario_id', $escenarioId)
    	->first([
    		'morning_start', 'morning_end',
    		'afternoon_start', 'afternoon_end',
            'receso'

    	]);

        //dd($workDay);

    	if ($workDay){
    		$morningIntervals = $this->getIntervals(
                $workDay->morning_start, 
                $workDay->morning_end,
                $date, 
                $escenarioId,
                $workDay->receso
            );

            $afternoonIntervals = $this->getIntervals(
                $workDay->afternoon_start, 
                $workDay->afternoon_end,
                $date, 
                $escenarioId,
                $workDay->receso
            );
    	}else{
            $morningIntervals = [];
            $afternoonIntervals = [];

        }

    	$data =[];
    	$data['morning'] = $morningIntervals;
    	$data['afternoon'] = $afternoonIntervals;
    	return $data;
	}

	private function  getDayFromDate($date)
  	{
    	$dateCarbon = new Carbon($date);
    	$i = $dateCarbon->dayOfWeek;
    	$day = ($i==0 ? 6: $i-1);
    	return $day;
  	}

	private function getIntervals($start, $end, $date, $escenarioId, $receso){ //agregar receso
    	//dd($start, $end, $date, $escenarioId, $receso);
        $start = new Carbon($start);
    	$end = new Carbon($end);

    	$intervals = [];

    	while($start < $end){
    		$interval = [];

    		$interval['start'] = $start->format('g:i A');

    		// NO exxiste disponibilidad
    		$available = $this->isAvailableInterval($date, $escenarioId, $start);

    		$start->addMinutes(60);
    		$interval['end'] = $start->format('g:i A');

    		if($available){
    			$intervals [] = $interval;
    		}
    		$start->addMinutes($receso);
    	}
    	return $intervals;
        
    }
}