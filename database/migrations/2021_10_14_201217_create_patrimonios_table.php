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
            
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');

            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('especialidad_id')->nullable();
            $table->foreign('especialidad_id')->references('id')->on('especialidades');

            $table->unsignedBigInteger('estilo_id')->nullable();
            $table->foreign('estilo_id')->references('id')->on('estilos');

            $table->unsignedBigInteger('tecnicamaterial_id')->nullable();
            $table->foreign('tecnicamaterial_id')->references('id')->on('tecnicamaterial');

            $table->string('localidad', 50)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('departamento', 15)->nullable();
            $table->string('inmueble', 120)->nullable();
            $table->string('calle', 500)->nullable();

            $table->string('nombre', 500)->nullable();
            $table->string('escuela', 200)->nullable();
            $table->string('epoca', 150)->nullable();
            $table->string('autor', 150)->nullable();

            $table->string('inventario', 150)->nullable();
            $table->string('inventario_anterior', 150)->nullable();
            $table->string('codigo', 150)->nullable();
            $table->string('codigo_balance', 150)->nullable();
            $table->string('origen', 150)->nullable();
            $table->string('obtencion', 150)->nullable();
            $table->string('fecha_adquisicion_texto', 50)->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->string('marcas', 500)->nullable();

            $table->decimal('alto', 15, 2)->nullable();
            $table->decimal('ancho', 15, 2)->nullable();
            $table->decimal('diametro', 15, 2)->nullable();
            $table->decimal('circunferencia', 15, 2)->nullable();
            $table->decimal('largo', 15, 2)->nullable();
            $table->decimal('profundidad', 15, 2)->nullable();
            $table->decimal('peso', 15, 2)->nullable();

            $table->text('descripcion')->nullable();

            $table->string('rollo', 10)->nullable();
            $table->string('fotografo', 50)->nullable();
            $table->string('fecha_fotografia', 10)->nullable();
            $table->string('toma', 10)->nullable();
            // $table->text('archivo_fotografico')->nullable();

            $table->text('especificacion_conservacion')->nullable();
            $table->text('intervenciones_realizadas')->nullable();
            $table->text('caracteristicas_tecnicas')->nullable();
            $table->text('caracteristicas_iconograficas')->nullable();
            $table->text('datos_historicos')->nullable();
            $table->text('referencias_bibliograficas')->nullable();
            $table->text('observaciones')->nullable();

            $table->string('catalogo', 200)->nullable();
            $table->string('fecha_catalogo', 50)->nullable();

            $table->string('elaboro', 200)->nullable();
            $table->string('fecha_elaboro', 50)->nullable();

            $table->string('reviso', 200)->nullable();
            $table->string('fecha_reviso', 50)->nullable();

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
