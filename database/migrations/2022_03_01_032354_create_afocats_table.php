<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfocatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afocats', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 10);
            $table->string('persona_dni', 8);
            $table->string('vendedor',150);
            $table->date('inicio_contrato');
            $table->date('fin_contrato');
            $table->date('inicio_certificado');
            $table->date('fin_certificado');
            $table->time('hora');
            $table->float('monto');
            $table->float('extraordinario')->nullable();

            $table->unsignedBigInteger('id_vehiculo');
            $table->foreign('id_vehiculo')->references('id')->on('vehiculos');
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
        Schema::dropIfExists('afocats');
    }
}
