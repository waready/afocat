<?php

use Illuminate\Database\Seeder;
use App\TipoAfiliado;

class TipoAfiliadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoAfiliado::create([
            'nombre'  => 'Persona Natural'

        ]);
        TipoAfiliado::create([
            'nombre'  => 'Empresa Juridica'
        ]);
    }
}
