<?php

use Illuminate\Database\Seeder;

class RespostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

         for($i = 0; $i < 5; $i++){
        	DB::table('respostas')->insert(['alternativa_questao'=> str_random(10), 'aluno_id' => $i, 'questao_id' => $i]);	
        }
    }
}
