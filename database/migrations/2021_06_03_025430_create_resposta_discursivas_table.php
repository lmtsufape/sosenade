<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostaDiscursivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta_discursivas', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('resposta_discursiva');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('simulado_id');
            $table->unsignedBigInteger('questao_discursiva_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('simulado_id')->references('id')->on('simulados');
            $table->foreign('questao_discursiva_id')->references('id')->on('questao_discursivas');
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
        Schema::dropIfExists('resposta_discursivas');
    }
}
