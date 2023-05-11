<?php

use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
            $this->call([
                AlunoSeeder::class,
                SimuladoSeeder::class,
                UnidadeAcademicaSeeder::class,
                CicloSeeder::class,
                CursoSeeder::class,
                DisciplinaSeeder::class,
                DisciplinaUPESeeder::class,
                QuestaoSeeder::class,
                QuestaoSimuladoSeeder::class,
                TipousuarioSeeder::class,
                UsuarioSeeder::class,
                InstituicaoSeeder::class
            ]);
        }
    }
