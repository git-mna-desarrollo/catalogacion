<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubespecialidadIdToPatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->unsignedBigInteger('subespecialidad_id')->nullable()->after('especialidad_id');
            $table->foreign('subespecialidad_id')->references('id')->on('subespecialidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->dropForeign(["subespecialidad_id"]);
            $table->dropColumn("subespecialidad_id");
        });
    }
}
