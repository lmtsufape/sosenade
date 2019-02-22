<?php

use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for($i = 0; $i < 6; $i++){
        	DB::table('ciclos')->insert(['tipo_ciclo'=> "2018"]);	
            DB::table('ciclos')->insert(['tipo_ciclo'=> "2019"]);
            DB::table('ciclos')->insert(['tipo_ciclo'=> "2020"]);
        //}
    }   
}
