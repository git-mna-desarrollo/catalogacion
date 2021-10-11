<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creador_id')->nullable();
            $table->foreign('creador_id')->references('id')->on('users');
            $table->unsignedBigInteger('modificador_id')->nullable();
            $table->foreign('modificador_id')->references('id')->on('users');
            $table->unsignedBigInteger('eliminador_id')->nullable();
            $table->foreign('eliminador_id')->references('id')->on('users');
            $table->unsignedBigInteger('patrimonio_id')->nullable();
            $table->foreign('patrimonio_id')->references('id')->on('users');
            $table->string('monumento_nacional', 2)->nullable();
            $table->string('resolucion_municipal', 2)->nullable();
            $table->string('resolucion_administrativa', 2)->nullable();
            $table->string('individual', 2)->nullable();
            $table->string('conjunto', 2)->nullable();
            $table->string('ninguna', 2)->nullable();
            $table->string('excelente', 2)->nullable();
            $table->string('bueno', 2)->nullable();
            $table->string('regular', 2)->nullable();
            $table->string('malo', 2)->nullable();
            $table->string('pesimo', 2)->nullable();
            $table->string('fragmento', 2)->nullable();
            $table->string('seguridad_buena', 2)->nullable();
            $table->string('seguridad_razonable', 2)->nullable();
            $table->string('seguridad_ninguna', 2)->nullable();
            $table->string('estado', 15)->nullable();
            $table->datetime('deleted_at')->nullable();

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
        Schema::dropIfExists('estados');
    }
}
