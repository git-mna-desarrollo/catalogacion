<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimonios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creador_id')->nullable();
            $table->foreign('creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('localidad_id')->nullable();
            $table->foreign('localidad_id')->references('id')->on('users');

            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('users');

            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->foreign('provincia_id')->references('id')->on('users');

            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('users');

            $table->unsignedBigInteger('tecnicamaterial_id')->nullable();
            $table->foreign('tecnicamaterial_id')->references('id')->on('tecnicamaterial');

            $table->string('direccion', 500)->nullable();
            $table->string('nombre', 150)->nullable();
            $table->string('especialidad', 200)->nullable();
            $table->string('estilo', 250)->nullable();
            $table->string('escuela', 150)->nullable();
            $table->string('epoca', 150)->nullable();
            $table->string('autor', 150)->nullable();

            $table->string('inventario', 150)->nullable();
            $table->string('codigo', 150)->nullable();
            $table->string('inventario_anterior', 150)->nullable();
            $table->string('origen', 150)->nullable();
            $table->string('obtencion', 150)->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->string('marcas', 500)->nullable();
            $table->text('dimenciones')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('archivo_fotografico')->nullable();
            $table->text('estado_conservacion')->nullable();
            $table->text('intervenciones_realizadas')->nullable();
            $table->text('caracteristicas_tecnicas')->nullable();
            $table->text('caracteristicas_iconograficas')->nullable();
            $table->text('datos_historicos')->nullable();
            $table->text('referencias_bibliograficas')->nullable();
            $table->text('observaciones')->nullable();

            $table->string('estado',15)->nullable();
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
        Schema::dropIfExists('patrimonios');
    }
}
