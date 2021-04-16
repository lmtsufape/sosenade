<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChaveCursoDisciplinaLessOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->dropForeign('disciplinas_curso_id_foreign');
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
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->dropForeign('disciplinas_curso_id_foreign');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }
}
