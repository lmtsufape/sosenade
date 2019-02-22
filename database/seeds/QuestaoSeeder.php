<?php

use Illuminate\Database\Seeder;

class QuestaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                    DB::table('questaos')->insert(['enunciado' => "", 'alternativa_a' => "", 'alternativa_b' => "", 'alternativa_c' => "",  'alternativa_d' => "",  'alternativa_e' => "", 'alternativa_correta' => 1,'dificuldade' => 0, 'disciplina_id' => 1]);
               
        }
}
