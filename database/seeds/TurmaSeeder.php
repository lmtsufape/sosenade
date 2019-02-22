<?php

use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          for($i = 0; $i < 6; $i++){
        	DB::table('turmas')->insert(['aluno_id'=> $i, 'ciclo_id'=> $i]);	
        }
    }
}
