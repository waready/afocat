<?php

use Illuminate\Database\Seeder;
use App\VehiculoUso;
class VehiculoUsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehiculoUso::create([
            'nombre'  => 'Interprovincail'
        ]);
        VehiculoUso::create([
            'nombre'  => 'InterUrbano'
        ]);
        VehiculoUso::create([
            'nombre'  => 'Urbano'
        ]);
        VehiculoUso::create([
            'nombre'  => 'Taxi'
        ]);
        VehiculoUso::create([
            'nombre'  => 'Particular'
        ]);
        VehiculoUso::create([
            'nombre'  => 'Carga'
        ]);
        VehiculoUso::create([
            'nombre'  => 'otros'
        ]);

    }
}
