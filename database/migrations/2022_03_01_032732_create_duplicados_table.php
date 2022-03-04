<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuplicadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duplicados', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 10);
            //$table->primary('numero');
            $table->date('emision');
            $table->time('hora');
            $table->float('monto');

            $table->unsignedBigInteger('id_afocat');
            $table->foreign('id_afocat')->references('id')->on('afocats');
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
        Schema::dropIfExists('duplicados');
    }
}
