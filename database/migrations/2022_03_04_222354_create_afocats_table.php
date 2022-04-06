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
       
            $table->date('inicio_contrato');//fecha de inicio
            $table->date('fin_contrato'); //1-2 años ?
            $table->unsignedTinyInteger('anios')->default(1);// numero años
            $table->string('numero_certificado')->nullable();
            $table->time('hora'); //sistemas

            $table->unsignedDecimal('monto_sbs', 12, 2);
            $table->unsignedDecimal('monto_total', 12, 2)->default(0);

            $table->unsignedBigInteger('id_producto'); // certificado afocat
            $table->foreign('id_producto')->references('id')->on('productos');

            $table->unsignedBigInteger('id_pago');
            $table->foreign('id_pago')->references('id')->on('pagos');

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
