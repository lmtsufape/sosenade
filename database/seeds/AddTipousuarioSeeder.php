<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AddTipousuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipousuarios')->insert(['tipo' => 'Administração Geral']);
    }
}
