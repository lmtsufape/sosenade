<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChaveDisciplinaQuestaoLessOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questaos', function (Blueprint $table) {
            $table->dropForeign('questaos_disciplina_id_foreign');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questaos', function (Blueprint $table) {
            $table->dropForeign('questaos_disciplina_id_foreign');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }
}
