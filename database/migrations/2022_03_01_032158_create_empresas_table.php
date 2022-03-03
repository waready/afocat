<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('ruc', 11);
          //  $table->primary('ruc');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('provincia');
            $table->string('departamento');
            $table->string('representante')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('nacimiento')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
