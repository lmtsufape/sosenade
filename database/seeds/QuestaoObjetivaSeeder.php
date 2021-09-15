<?php

use Illuminate\Database\Seeder;

class QuestaoObjetivaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplinas = DB::table('disciplinas')->where('curso_id', 44)->get();
        foreach($disciplinas as $disciplina) {
            DB::table('questaos')->where('disciplina_id', $disciplina->id)->delete();
        }
    }
}
