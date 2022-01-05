<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposTecnicasMaterialesToPatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrimonios', function (Blueprint $table) {
            $table->string('tecnicas', 250)->nullable()->after('tecnicamaterial_id');
            $table->string('materiales', 250)->nullable()->after('tecnicas');
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
            $table->dropColumn('tecnicas');
            $table->dropColumn('materiales');
        });
    }
}
