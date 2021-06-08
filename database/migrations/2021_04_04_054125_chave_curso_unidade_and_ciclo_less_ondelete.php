<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChaveCursoUnidadeAndCicloLessOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropForeign('cursos_unidade_id_foreign');
            $table->dropForeign('cursos_ciclo_id_foreign');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('unidade_id')->references('id')->on('unidade_academicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursos', function (Blueprint $table) {
            
        });
    }
}
