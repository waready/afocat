<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfiliacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliaciones', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->nullable();
            $table->string('ruc', 11)->nullable();
            $table->string('nombre');
            $table->string('representante')->nullable();
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('direccion')->nullable();
            $table->string('provincia')->nullable();
            $table->string('departamento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('nacimiento')->nullable();

            $table->unsignedBigInteger('id_tipo_afiliacion');
            $table->foreign('id_tipo_afiliacion')->references('id')->on('tipo_afiliados');
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
        Schema::dropIfExists('afiliaciones');
    }
}
