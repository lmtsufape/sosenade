<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cnpj')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('tipousuario_id')->unsigned()->nullable();
            $table->foreign('tipousuario_id')->references('id')->on('tipousuarios');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicoes');
    }
}
