<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChaveQuestaoQuestaosimuladoLessOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questao_simulados', function (Blueprint $table) {
            $table->dropForeign('questao_simulados_questao_id_foreign');
            $table->foreign('questao_id')->references('id')->on('questaos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questao_simulados', function (Blueprint $table) {
            
        });
    }
}
