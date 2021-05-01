<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UpdateLMTSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Atualizar tipousuario_id de Adm geral da UFAPE
        DB::table('usuarios')
            ->where('email', 'lmts@ufrpe.br')
            ->update(['tipousuario_id' => 6]);
    }
}
