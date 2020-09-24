<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Escenario;

class EscenarioController extends Controller
{
    public function index()
    {
    	return Escenario::all(['id', 'name','description', 'longitud', 'latitud']);
    }
}
