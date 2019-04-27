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
            $table->longText('enunciado');
            $table->longText('alternativa_a');
            $table->longText('alternativa_b');
			$table->longText('alternativa_c');
			$table->longText('alternativa_d');
			$table->longText('alternativa_e');
			$table->longText('alternativa_correta');
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
