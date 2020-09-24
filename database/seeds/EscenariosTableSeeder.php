<?php

use Illuminate\Database\Seeder;
use App\Escenario;

class EscenariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Escenario::create([
            'name' => 'Coliseo cubierto principal',
            'description' => 'Escenario deportivo que se encuentra en el centro del municipio abierto al publico en general para la practica de actividades deportivas,',
            'address' => 'Cra. 7 #8-45 madrid. cundinamarca',
            'longitud' => '-74.26264429999999',
            'latitud' => '4.7343337'
        ]);
        Escenario::create([
            'name' => 'Polideportivo Guatamala',
            'description' => 'Escenario deportivo para la practica de actividades deportivas, abierto entre las 8am y 5pm.',
            'address' => 'Cra. 6 #19-1, Madrid, Cundinamarca',
            'longitud' => '-74.25573229999999',
            'latitud' => '4.737922500000001'
        ]);
        Escenario::create([
            'name' => 'Estadio municipal',
            'description' => 'Estadio creado para la practica de Fútbol sala a nivel profecional',
            'address' => 'Cra. 7 #845, Madrid, Cundinamarca',
            'longitud' => '-74.26264429999999',
            'latitud' => '4.7343337'
        ]);
    }
}
