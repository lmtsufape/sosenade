<?php

use Illuminate\Database\Seeder;

class TipousuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tipousuarios')->insert(['tipo' => 'Aluno']);
    	DB::table('tipousuarios')->insert(['tipo' => 'Coordenador']);
    	DB::table('tipousuarios')->insert(['tipo' => 'Professor']);
        DB::table('tipousuarios')->insert(['tipo' => 'Admistrador']);
        //
    }
}
