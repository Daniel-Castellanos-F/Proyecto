<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Escenario;
use App\User;
use App\WorkDay;
use Carbon\Carbon;


use App\Http\Controllers\Controller;

class EscenarioController extends Controller
{
      public function index()
    {
    	$Escenarios = Escenario::all();
    	return view('Escenarios.index', compact('Escenarios'));
    }

    public function create()
    {

    	return view('Escenarios.create');
    }
    private function performValidation(request $request)
    {
        $rules = [
            'name' => 'required|min:8',
            'description' => 'required',
            'address' => 'required'
        ];
        $messages = [
            'name.required' => 'Es Necesario ingresar un nombre.',
            'name.min' => 'Como minimo el nombre debe tener 8 caracteres.',
        ];
        $this->validate($request, $rules, $messages);
    }


    public function store(Request $request)
    {
    	
        $this->performValidation($request);

    	$Escenario = new Escenario();
    	$Escenario->name = $request->input('name');
    	$Escenario->description = $request->input('description');
    	$Escenario->address = $request->input('address');
    	$Escenario->save();

        $notification ='El Escenario se ha registrado correctamente.';
    	return redirect('/Escenarios')->with(compact('notification'));
    }

    public function edit(Escenario $Escenario)
    {
       $escen_id = $Escenario->id; 
       $days =[
            'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
        ];

        $workDays = WorkDay::where('escenario_id',$escen_id)->get();

        if( count($workDays) > 0 ){
            $workDays->map(function ($workDay) {
                $workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
                $workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
                $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
                $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');
                return $workDay;
            });

       }else{
           $workDays = collect();
           for($i=0 ; $i<7; ++$i)
                $workDays->push(new WorkDay());
       }

 
    	return view('Escenarios.edit', compact('workDays', 'days','Escenario'));
    }

	public function update(Request $request, Escenario $Escenario)
    {
    	$this->performValidation($request);
        
    	$Escenario->name = $request->input('name');
    	$Escenario->description = $request->input('description');
    	$Escenario->address = $request->input('address');
    	$Escenario->save();

        $notification ='El Escenario se ha actualizado correctamente.';
    	return redirect('/Escenarios')->with(compact('notification'));
    }

    public function destroy(Escenario $Escenario)
    {
        $deletedEscenario = $Escenario->name;
    	$Escenario->delete();
        $notification ='El Escenario '.$deletedEscenario.' se ha eliminado correctamente.';
    	return redirect('/Escenarios')->with(compact('notification'));
    }

}
