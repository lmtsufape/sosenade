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


        //Criação de Adm geral da UFAPE
        // DB::table('usuarios')->insert(['nome' => 'ufap', 'cpf' => '12345678901', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'lmts@ufrpe.br', 'tipousuario_id' => 4, 'curso_id' => 1]);


        //Criação de Coordenador do primeiro curso
        // DB::table('usuarios')->insert(['nome' => 'Coordenador', 'cpf' => '12345678911', 'password' => $senhac, 'remember_token' =>$remember_token, 'email' => 'coordenador-teste@ufrpe.br', 'tipousuario_id' => 2, 'curso_id' => 1]);

        //Criação de professor

        // DB::table('usuarios')->insert(['nome' => 'Professor', 'cpf' => '02345678913', 'password' => $senhap, 'remember_token' =>$remember_token, 'email' => 'professor-teste@ufrpe.br', 'tipousuario_id' => 3, 'curso_id' => 1]);

        //Criação do adm geral do sistema
        // DB::table('usuarios')->insert(['nome' => 'LMTS', 'cpf' => '12345678901', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'admingeral@ufape.br', 'tipousuario_id' => 6, 'curso_id' => 1]);

        //Criação de coordenadores de cursos (UPE)
        DB::table('usuarios')->insert(['nome' => 'Coordenador Matemática (Garanhuns)', 'cpf' => '29485149019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_matematica_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 24]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Computação (Garanhuns)', 'cpf' => '19485149019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_computacao_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 25]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador História (Garanhuns)', 'cpf' => '29485149018', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_historia_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 26]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Geografia (Garanhuns)', 'cpf' => '29485049019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_geografia_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 27]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Letras-Português (Garanhuns)', 'cpf' => '29485149119', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_letras_portugues_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 28]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Biologicas (Garanhuns)', 'cpf' => '29585149019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_biologicas_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 29]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Pedagogia (Garanhuns)', 'cpf' => '29385149019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_pedagogia_garanhuns@upe.br', 'tipousuario_id' => 2, 'curso_id' => 30]);

        DB::table('usuarios')->insert(['nome' => 'Coordenador Letras-Português|Inglês (Mata Norte)', 'cpf' => '29485239019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_letras_portugues_ingles_matanorte@upe.br', 'tipousuario_id' => 2, 'curso_id' => 34]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Letras-Português|Espanhol (Mata Norte)', 'cpf' => '29485158019', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_letras_portugues_espanhol_matanorte@upe.br', 'tipousuario_id' => 2, 'curso_id' => 35]);

        DB::table('usuarios')->insert(['nome' => 'Coordenador Educação Física (Santo Amaro)', 'cpf' => '29485148119', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_educacao_fisica_santoamaro@upe.br', 'tipousuario_id' => 2, 'curso_id' => 45]);
        DB::table('usuarios')->insert(['nome' => 'Coordenador Ciências Sociais (Santo Amaro)', 'cpf' => '29485149111', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'coordenador_ciencias_sociais_santoamaro@upe.br', 'tipousuario_id' => 2, 'curso_id' => 46]);

        //Criação de professores dos cursos (UPE)
        // Anna (Semeador de Questões)
        DB::table('usuarios')->insert(['nome' => 'Professor Matemática (Garanhuns)', 'cpf' => '10582746492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_matematica_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 24]);
        DB::table('usuarios')->insert(['nome' => 'Professor Computação (Garanhuns)', 'cpf' => '10582746491', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_computacao_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 25]);
        DB::table('usuarios')->insert(['nome' => 'Professor História (Garanhuns)', 'cpf' => '10582746482', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_historia_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 26]);
        DB::table('usuarios')->insert(['nome' => 'Professor Geografia (Garanhuns)', 'cpf' => '10582546492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_geografia_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 27]);
        DB::table('usuarios')->insert(['nome' => 'Professor Letras-Português (Garanhuns)', 'cpf' => '10582745492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_letras_portugues_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 28]);
        DB::table('usuarios')->insert(['nome' => 'Professor Biologicas (Garanhuns)', 'cpf' => '10582746482', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_biologicas_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 29]);
        DB::table('usuarios')->insert(['nome' => 'Professor Pedagogia (Garanhuns)', 'cpf' => '10582779492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_pedagogia_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 30]);
        DB::table('usuarios')->insert(['nome' => 'Professor Letras-Português|Inglês (Mata Norte)', 'cpf' => '11582746492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_letras_portugues_ingles_matanorte@upe.br', 'tipousuario_id' => 3, 'curso_id' => 34]);
        DB::table('usuarios')->insert(['nome' => 'Professor Letras-Português|Espanhol (Mata Norte)', 'cpf' => '10583746492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_letras_portugues_espanhol_matanorte@upe.br', 'tipousuario_id' => 3, 'curso_id' => 35]);
        DB::table('usuarios')->insert(['nome' => 'Professor Educação Física (Santo Amaro)', 'cpf' => '10682746492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_educacao_fisica_santoamaro@upe.br', 'tipousuario_id' => 3, 'curso_id' => 45]);
        DB::table('usuarios')->insert(['nome' => 'Professor Ciências Sociais (Santo Amaro)', 'cpf' => '11582746492', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_anna_ciencias_sociais_santoamaro@upe.br', 'tipousuario_id' => 3, 'curso_id' => 46]);

        // Breno (Semeador de Questões)
        DB::table('usuarios')->insert(['nome' => 'Professor Matemática (Garanhuns)', 'cpf' => '29482741051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_matematica_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 24]);
        DB::table('usuarios')->insert(['nome' => 'Professor Computação (Garanhuns)', 'cpf' => '29482741052', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_computacao_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 25]);
        DB::table('usuarios')->insert(['nome' => 'Professor História (Garanhuns)', 'cpf' => '29482731051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_historia_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 26]);
        DB::table('usuarios')->insert(['nome' => 'Professor Geografia (Garanhuns)', 'cpf' => '28482741051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_geografia_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 27]);
        DB::table('usuarios')->insert(['nome' => 'Professor Letras-Português (Garanhuns)', 'cpf' => '29483741051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_letras_portugues_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 28]);
        DB::table('usuarios')->insert(['nome' => 'Professor Biologicas (Garanhuns)', 'cpf' => '29482741151', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_biologicas_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 29]);
        DB::table('usuarios')->insert(['nome' => 'Professor Pedagogia (Garanhuns)', 'cpf' => '29482754051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_pedagogia_garanhuns@upe.br', 'tipousuario_id' => 3, 'curso_id' => 30]);
        DB::table('usuarios')->insert(['nome' => 'Professor Letras-Português|Inglês (Mata Norte)', 'cpf' => '29432741051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_letras_portugues_ingles_matanorte@upe.br', 'tipousuario_id' => 3, 'curso_id' => 34]);
        DB::table('usuarios')->insert(['nome' => 'Professor Letras-Português|Espanhol (Mata Norte)', 'cpf' => '28982741051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_letras_portugues_espanhol_matanorte@upe.br', 'tipousuario_id' => 3, 'curso_id' => 35]);
        DB::table('usuarios')->insert(['nome' => 'Professor Educação Física (Santo Amaro)', 'cpf' => '29482751051', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_educacao_fisica_santoamaro@upe.br', 'tipousuario_id' => 3, 'curso_id' => 45]);
        DB::table('usuarios')->insert(['nome' => 'Professor Ciências Sociais (Santo Amaro)', 'cpf' => '29482741151', 'password' => $password, 'remember_token' =>$remember_token, 'email' => 'professor_breno_ciencias_sociais_santoamaro@upe.br', 'tipousuario_id' => 3, 'curso_id' => 46]);

    }
}
