<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChaveCursoUsuarioLessOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('usuarios_curso_id_foreign');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {      
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('usuarios_curso_id_foreign');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }
}
