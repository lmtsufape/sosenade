<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
    {
        $password = \Hash::make('12345678');
        $senhac = \Hash::make('12345678');
        $senhap = \Hash::make('12345678');
        $remember_token = str_random(10);
        //for($i = 1; $i < 4; $i++){
        //DB::table('usuarios')->insert(['nome' => str_random(10), 'cpf' => str_random(10),'password' => $password, 'remember_token' =>$remember_token, 'email' => str_random(10), 'tipousuario_id' => 1, 'curso_id' => 1]);
        //}


        //Criação de Adm geral do sistema
        DB::table('usuarios')->insert(['nome' => 'LMTS', 'cpf' => '12345678901', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'lmts@ufrpe.com', 'tipousuario_id' => 4, 'curso_id' => 1]);


        //Criação de Coordenador do primeiro curso
        DB::table('usuarios')->insert(['nome' => 'Coordenador', 'cpf' => '12345678911', 'password' => $senhac, 'remember_token' =>$remember_token, 'email' => 'coordenador@ufrpe.br', 'tipousuario_id' => 2, 'curso_id' => 1]);

        //Criação de professor

        DB::table('usuarios')->insert(['nome' => 'Professor', 'cpf' => '02345678913', 'password' => $senhap, 'remember_token' =>$remember_token, 'email' => 'professor@ufrpe.br', 'tipousuario_id' => 3, 'curso_id' => 1]);

    }
}