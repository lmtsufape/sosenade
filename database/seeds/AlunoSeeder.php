<?php

use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for($i = 1; $i < 5; $i++){
    		DB::table('alunos')->insert(['nome' => "Aluno", 'cpf' =>"12345678911", 'password' => \Hash::make('12345678'), 'email' =>  "estudante--teste@ufrpe.br", 'curso_id' => 1]);
    	//}
    }
}
