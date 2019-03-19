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
        $password = \Hash::make('123456');
        $senhac = \Hash::make('12345678');
        $remember_token = str_random(10);
        //for($i = 1; $i < 4; $i++){
        //DB::table('usuarios')->insert(['nome' => str_random(10), 'cpf' => str_random(10),'password' => $password, 'remember_token' =>$remember_token, 'email' => str_random(10), 'tipousuario_id' => 1, 'curso_id' => 1]);
        //}

        DB::table('usuarios')->insert(['nome' => 'LMTS', 'cpf' => '1234567890', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'lmts@ufrpe.com', 'tipousuario_id' => 4, 'curso_id' => 1]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador', 'cpf' => '1234567891', 'password' => $senhac, 'remember_token' =>$remember_token, 'email' => 'Coordenador@ufrpe.com', 'tipousuario_id' => 2, 'curso_id' => 1]);

    }
}