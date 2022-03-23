<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 10);
            $table->string('marca');
            $table->string('modelo');
            $table->string('color')->nullable();
            $table->string('clase');
            $table->string('categoria')->nullable();
            $table->integer('asientos')->nullable();
            $table->integer('anio');
            $table->unsignedBigInteger('id_uso');
            $table->foreign('id_uso')->references('id')->on('vehiculo_usos');
            $table->string('serie')->nullable();
            $table->string('motor');
            $table->unsignedBigInteger('id_afiliado');
            $table->foreign('id_afiliado')->references('id')->on('afiliados');
            $table->timestamps();

            /**vehiculo cambia de duelo --quien cobra siniestro -- se guarda el mismo vehiculo con difirente afiliado**/
            /**hidde(empresa||persona) */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
