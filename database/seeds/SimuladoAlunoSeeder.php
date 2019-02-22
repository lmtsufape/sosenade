<?php

use Illuminate\Database\Seeder;

class SimuladoAlunoSeeder extends Seeder
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
        	DB::table('simulado_alunos')->insert(['aluno_id'=> $i, 'simualdo_id' => $i]);	
        }
    }
}
