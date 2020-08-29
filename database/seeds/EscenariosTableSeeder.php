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
            'name' => 'Pista de patinaje',
            'description' => 'Pista donde se puede practicar el deporte del patinaje de forma profecional',
            'address' => 'Calle 12 A # 2-32'
        ]);
        Escenario::create([
            'name' => 'micro--futbol',
            'description' => 'Escenario deportivo que se encuentra en el centro del municipio abierto al publico en general para la practica de actividades deportivas, abierto entre las 8am y 7pm.',
            'address' => 'Calle 12 A # 2-32'
        ]);
        Escenario::create([
            'name' => 'Piscina los Azulejos',
            'description' => 'Piscina para el aprendizaje de la practica de la natación para niños entre los 5 y 10 años',
            'address' => 'Avenida siempre viva 12 # 6-6'
        ]);
    }
}
