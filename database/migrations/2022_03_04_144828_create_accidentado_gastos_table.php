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
            
            $table->unsignedDecimal('Pagado', 12, 2);
            $table->unsignedDecimal('Pendiente', 12, 2);
            $table->date('fecha_limite');

            $table->unsignedBigInteger('id_gasto');
            $table->foreign('id_gasto')->references('id')->on('gastos');

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
