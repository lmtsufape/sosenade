<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UpdateCicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Atribuir instituicao_id de UFAPE aos ciclos cadastrados
        DB::table('ciclos')
            ->where('instituicao_id', null)
            ->update(['instituicao_id' => DB::table('instituicoes')->where('email', 'lmts@ufape.edu.br')->value('id')]);
    }
}
