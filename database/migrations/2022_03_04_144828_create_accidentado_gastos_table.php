<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentadoGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidentado_gastos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedDecimal('monto_pagado', 12, 2);
            //$table->unsignedDecimal('Pendiente', 12, 2);
            $table->date('fecha_pago');
            $table->time('hora');
            // $table->unsignedBigInteger('id_gasto');
            // $table->foreign('id_gasto')->references('id')->on('gastos');
            $table->unsignedBigInteger('id_tipo_pago');
            $table->foreign('id_tipo_pago')->references('id')->on('tipo_pagos');

            $table->string('archivo_path')->nullable();

            $table->unsignedBigInteger('id_accidentado');
            $table->foreign('id_accidentado')->references('id')->on('accidentados');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accidentado_gastos');
    }
}
