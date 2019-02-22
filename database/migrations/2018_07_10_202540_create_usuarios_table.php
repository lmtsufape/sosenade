<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cpf');
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('tipousuario_id')->unsigned()->nullable();
            $table->integer('curso_id')->unsigned()->nullable();
            $table->foreign('tipousuario_id')->references('id')->on('tipousuarios')->onDelete('set null');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('set null');
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
        Schema::dropIfExists('usuarios');
    }
}
