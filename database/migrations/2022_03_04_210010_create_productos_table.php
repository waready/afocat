<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->string('codigo', 50)->nullable()->unique();
            $table->string('nombre'); // nombre completo
            $table->string('numero_certificado')->nullable();//Nro. Del Certificado
            $table->string('abreviatura', 80)->nullable();
            $table->unsignedDecimal('precio_unitario');//monto
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_vencimiento')->nullable();
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
        Schema::dropIfExists('productos');
    }
}
