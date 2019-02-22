<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimuladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curso_id')->unsigned()->nullable();
            $table->string('descricao_simulado');
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('set null');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('set null');
            ##Saber quando se foi realizado o simulado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simulados');
    }
}
