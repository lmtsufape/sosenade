<?php

use Illuminate\Database\Seeder;

class QuestaoSimuladoSeeder extends Seeder
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
        	DB::table('questao_simulados')->insert(['questao_id'=> $i, 'simulado_id' => $i]);	
        }
    }
    }
}
