<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instituicoes')->insert(
            ['nome' => 'UFAPE', 'cnpj' => '35.872.812/0001-01', 'email' => 'lmts@ufape.edu.br', 'password' => \Hash::make('2021UFAPElmts'), 'tipousuario_id' => 4]
        );
    }
}
