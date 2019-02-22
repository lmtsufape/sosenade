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
        $remember_token = str_random(10);
        //for($i = 1; $i < 4; $i++){
            DB::table('usuarios')->insert(['nome' => str_random(10), 'cpf' => str_random(10),'password' => $password, 'remember_token' =>$remember_token, 'email' => str_random(10), 'tipousuario_id' => 1, 'curso_id' => 1]);
        //}

        DB::table('usuarios')->insert(['nome' => 'cezar', 'cpf' => '1234567890', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'cezar.cordeiro@outlook.com', 'tipousuario_id' => 4, 'curso_id' => 1]);

    }
}