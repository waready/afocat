<?php

use Illuminate\Database\Seeder;
use App\Gasto;
class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gasto::create([
            'nombre'  => 'Muerte c/u',
            'monto'   => 4600,
        ]);
        Gasto::create([
            'nombre'  => 'Invalides Permanente c/u',
            'monto'   =>4 *(4600),
        ]);
        Gasto::create([
            'nombre'  => 'Invalides Temporal c/u',
            'monto'   => 4600,
        ]);
        Gasto::create([
            'nombre'  => 'Gastos Medicos c/u',
            'monto'   =>5*(4600),
        ]);
        Gasto::create([
            'nombre'  => 'Gastos Cepelio c/u',
            'monto'   =>4600
        ]);
    }
}
