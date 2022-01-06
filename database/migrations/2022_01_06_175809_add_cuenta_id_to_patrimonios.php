<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCuentaIdToPatrimonios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->unsignedBigInteger('cuenta_id')->nullable()->after('tecnicamaterial_id');
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
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
            $table->dropForeign(["cuenta_id"]);
            $table->dropColumn("cuenta_id");
        });
    }
}
