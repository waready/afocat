<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidentados', function (Blueprint $table) {
            $table->id();
            $table->string('dni',8);
            $table->string('nombres');
            // $table->unsignedBigInteger('id_tipo_pago');
            // $table->foreign('id_tipo_pago')->references('id')->on('tipo_pagos');
            $table->unsignedBigInteger('id_gasto');
            $table->foreign('id_gasto')->references('id')->on('gastos');
            $table->string('a_82');
            $table->string('cuenta_a_82');
            $table->unsignedBigInteger('id_accidente');
            $table->foreign('id_accidente')->references('id')->on('accidentes');
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
        Schema::dropIfExists('accidentados');
    }
}
