<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UpdateUnidadeAcademicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Atribuição de instituicao_id de UFAPE para todas as instituicoes no DB com campo instituicao id nulo
        DB::table('unidade_academicas')
            ->where('instituicao_id', null)
            ->update(['instituicao_id' => DB::table('instituicoes')->where('email', 'lmts@ufape.edu.br')->value('id') ]);
    }
}
