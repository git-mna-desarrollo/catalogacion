<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechasToPatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->date('fec_catalogo')->nullable()->after('catalogo');
            $table->date('fec_elaboro')->nullable()->after('elaboro');
            $table->date('fec_reviso')->nullable()->after('reviso');
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
            $table->dropColumn('fec_catalogo');
            $table->dropColumn('fec_elaboro');
            $table->dropColumn('fec_reviso');
        });
    }
}
