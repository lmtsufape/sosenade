<?php

use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; $i++){
        	DB::table('cursos')->insert(['ciclo_id'=> 1, 'curso_nome'=> "Ciência da Computação", 'unidade_id' => 2]);

            DB::table('cursos')->insert(['ciclo_id'=> 1, 'curso_nome'=> "Agronomia", 'unidade_id' => 2]);
        //}
            DB::table('cursos')->insert(['ciclo_id'=> 1, 'curso_nome'=> "Eng de Alimentos", 'unidade_id' => 3]);

            DB::table('cursos')->insert(['ciclo_id'=> 1, 'curso_nome'=> "Letras", 'unidade_id' => 2]);

            DB::table('cursos')->insert(['ciclo_id'=> 1, 'curso_nome'=> "Eng de Pesca", 'unidade_id' => 2]);
        //}
            DB::table('cursos')->insert(['ciclo_id'=> 1, 'curso_nome'=> "Eng de Produção", 'unidade_id' => 3]);
        }
    }
}
