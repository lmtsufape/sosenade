<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questaos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enunciado');
            $table->string('alternativa_a');
            $table->string('alternativa_b');
			$table->string('alternativa_c');
			$table->string('alternativa_d');
			$table->string('alternativa_e');
			$table->string('alternativa_correta');
            $table->integer('dificuldade');
            $table->integer('disciplina_id')->unsigned()->nullable();

			$table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('set null');
				
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
        Schema::dropIfExists('questaos');
    }
}
