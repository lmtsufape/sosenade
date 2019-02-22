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
				DB::table('disciplinas')->insert(['nome' => str_random(8), 'curso_id' => 1]);
			//}
    }
}
