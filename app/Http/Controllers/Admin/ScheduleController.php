    <?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Escenario;
use App\User;
use App\WorkDay;

class ScheduleController extends Controller
{
	private $days = [
            'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
    ];
    public function edit()
    {
    	
    }

     public function store(Request $request)
    {
		//dd($request->all());
		$active = $request->input('active') ?: [];
    	$morning_start = $request->input('morning_start');
    	$morning_end = $request->input('morning_end');
    	$afternoon_start = $request->input('afternoon_start');
    	$afternoon_end = $request->input('afternoon_end');
    	$escenario_id = $request->input('escenario_id');
        $receso = $request->input('receso');
        $cupos = $request->input('cupos');

    	$errors = [];

    	for ($i=0; $i<7; ++$i) {	

    		if ($morning_start[$i] > $morning_end[$i]){
    			$errors[] = 'Las horas del turno mañana son inconsistentes para el día '. $this->days[$i].'.';
    		}
    		if ($afternoon_start[$i] > $afternoon_end[$i]){
    			$errors[] = 'Las horas del turno tarde son inconsistentes para el día '. $this->days[$i].'.';
    		}

	    	WorkDay::updateOrCreate(
	    		[
	    			'day' => $i,
	    			'escenario_id' => $escenario_id[$i],
	    		], [
	    			'active' => in_array($i, $active),

			       	'morning_start' => $morning_start[$i],
			       	'morning_end' => $morning_end[$i],

			       	'afternoon_start' => $afternoon_start[$i],
			       	'afternoon_end' => $afternoon_end[$i],
                    'receso' => $receso[$i],
                    'cupos' => $cupos[$i]
	    		]
	    	); 
	    }

	    if (count($errors) > 0)
	    	return back()->with(compact('errors'));

	    $notification = 'Los cambios se han guardado correctamente.';
	    return back()->with(compact('notification'));
    }
}
