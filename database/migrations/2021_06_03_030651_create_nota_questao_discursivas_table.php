<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaQuestaoDiscursivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_questao_discursivas', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('comentario');
            $table->float('nota');
            $table->unsignedBigInteger('resposta_discursiva_id');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('resposta_discursiva_id')->references('id')->on('resposta_discursivas');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('nota_questao_discursivas');
    }
}
