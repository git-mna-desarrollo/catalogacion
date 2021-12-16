<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposadmToPatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->string('codigo_administrativo', 50)->nullable()->after('estado');
            $table->string('prefijo_administrativo', 50)->nullable()->after('estado');
            $table->string('forma_adquisicion', 20)->nullable()->after('estado');
            $table->date('fecha_ingreso_adm')->nullable()->after('estado');
            $table->decimal('valor', 15,2)->nullable()->after('estado');
            $table->string('cuenta', 20)->nullable()->after('estado');
            $table->string('sub_cuenta', 20)->nullable()->after('estado');
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
            $table->dropColumn('codigo_administrativo');
            $table->dropColumn('prefijo_administrativo');
            $table->dropColumn('forma_adquisicion');
            $table->dropColumn('fecha_ingreso_adm');
            $table->dropColumn('valor');
            $table->dropColumn('cuenta');
            $table->dropColumn('sub_cuenta');

        });
    }
}