<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->unsignedDecimal('monto_pagado', 12, 2)->nullable(); // 100
            $table->unsignedDecimal('monto_devuelto', 12, 2)->default(0); // 25
            $table->unsignedDecimal('monto', 12, 2);// 75
            $table->softDeletes();
            $table->string('hash', 6)->unique();

            $table->date('fecha'); //fecha de pago 
            $table->unsignedTinyInteger('tipo')->default(1); // 1=>boleta, 2=>factura, 3=>RECIBO
            $table->unsignedInteger('serie')->nullable();   // identificador asignado

            $table->unsignedBigInteger('id_tipo_pago')->nullable(); // pago en efecivo, electronico. etc
            $table->foreign('id_tipo_pago')->references('id')->on('tipo_pagos');
            
            $table->unsignedBigInteger('id_user_eliminador')->nullable(); // usuario que elimino
            $table->foreign('id_user_eliminador')->references('id')->on('users');

            $table->unsignedBigInteger('id_user'); // usuario creador
            $table->foreign('id_user')->references('id')->on('users');

            $table->unsignedBigInteger('id_afiliado');
            $table->foreign('id_afiliado')->references('id')->on('afiliados');

            $table->unsignedBigInteger('id_vehiculo')->nullable();
            $table->foreign('id_vehiculo')->references('id')->on('vehiculos');

            $table->unsignedBigInteger('id_producto')->nullable();
            $table->foreign('id_producto')->references('id')->on('productos');


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
        Schema::dropIfExists('pagos');
    }
}
