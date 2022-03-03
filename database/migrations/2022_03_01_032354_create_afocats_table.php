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
           // $table->primary('numero');
            $table->string('persona_dni', 8);
            $table->string('vendedor',150);
            $table->unsignedBigInteger('id_placa');
            $table->foreign('id_placa')->references('id')->on('vehiculos')->onUpdate('cascade')->onDelete('cascade');
            $table->date('inicio_contrato');
            $table->date('fin_contrato');
            $table->date('inicio_certificado');
            $table->date('fin_certificado');
            $table->time('hora');
            $table->float('monto');
            $table->float('extraordinario')->nullable();
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
