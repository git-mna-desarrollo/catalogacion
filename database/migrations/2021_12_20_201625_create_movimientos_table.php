<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('creador_id')->nullable();
            $table->foreign('creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('patrimonio_id')->nullable();
            $table->foreign('patrimonio_id')->references('id')->on('patrimonios');

            $table->unsignedBigInteger('asignado_id')->nullable();
            $table->foreign('asignado_id')->references('id')->on('users');

            $table->unsignedBigInteger('destino_id')->nullable();
            $table->foreign('destino_id')->references('id')->on('ubicaciones');
            
            $table->unsignedBigInteger('sitio_id')->nullable();
            $table->foreign('sitio_id')->references('id')->on('sitios');

            $table->string('observaciones', 500)->nullable();

            $table->string('estado', 15)->nullable();
            $table->softDeletes('deleted_at', 0);

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
        Schema::dropIfExists('movimientos');
    }
}