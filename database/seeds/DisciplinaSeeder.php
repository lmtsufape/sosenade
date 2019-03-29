<?php

use Illuminate\Database\Seeder;

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for($i = 1; $i < 6; $i++) {
		DB::table('disciplinas')->insert(['nome' => 'AED', 'curso_id' => 1]);
        DB::table('disciplinas')->insert(['nome' => 'AED2', 'curso_id' => 1]);
        DB::table('disciplinas')->insert(['nome' => 'Desenvolvimento Web', 'curso_id' => 1]);
        DB::table('disciplinas')->insert(['nome' => 'PAA', 'curso_id' => 1]);
        DB::table('disciplinas')->insert(['nome' => 'POO', 'curso_id' => 1]);
        DB::table('disciplinas')->insert(['nome' => 'IP', 'curso_id' => 1]);
			//}
    }
}
