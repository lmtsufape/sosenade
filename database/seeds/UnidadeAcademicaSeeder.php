<?php

use Illuminate\Database\Seeder;

class UnidadeAcademicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('unidade_academicas')->insert(['nome' => 'SEDE']);
    	DB::table('unidade_academicas')->insert(['nome' => 'UAG-UFRPE']);
    	DB::table('unidade_academicas')->insert(['nome' => 'UAST-UFRPE']);
    	DB::table('unidade_academicas')->insert(['nome' => 'UACSA-UFRPE']);
    }
}
