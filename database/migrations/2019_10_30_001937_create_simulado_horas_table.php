<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimuladoHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulado_horas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('simulado_id')->unsigned();
            $table->integer('aluno_id')->unsigned();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('simulado_id')->references('id')->on('simulados')->onDelete('cascade');
            $table->timestamp('hora_inicio_simulado')->nullable();
            $table->timestamp('hora_fim_simulado')->nullable();
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
        Schema::dropIfExists('simulado_horas');
    }
}
