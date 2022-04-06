<?php

use Illuminate\Database\Seeder;
use App\TipoPago;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPago::create([
            'nombre'  => 'Efectivo'
        ]);
        TipoPago::create([
            'nombre'  => 'Transferencia Bancaria'
        ]);
        TipoPago::create([
            'nombre'  => 'Cheque'
        ]);
        TipoPago::create([
            'nombre'  => 'Otro'
        ]);
    }
}
