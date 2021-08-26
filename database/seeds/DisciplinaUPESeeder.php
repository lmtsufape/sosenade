<?php

use Illuminate\Database\Seeder;

class DisciplinaUPESeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $matematica_garanhuns = 24;
        $computacao_garanhuns = 25;
        $historia_garanhuns = 26;
        $geografia_garanhuns = 27;
        $letras_portugues_garanhuns = 28;
        $biologicas_garanhuns = 29;
        $pedagogia_garanhuns = 30;

        $disciplinas_matematica = [
            'ANÁLISE MATEMÁTICA I',
            'ANÁLISE MATEMÁTICA II',
            'CÁLCULO I',
            'CÁLCULO II',
            'CÁLCULO III',
            'MATEMÁTICA BÁSICA I',
            'MATEMÁTICA BÁSICA II',
            'ÁLGEBRA LINEAR I',
            'ÁLGEBRA LINEAR II',
            'GEOMETRIA PLANA',
            'GEOMETRIA ESPACIAL',
            'GEOMETRIA ANALÍTICA',
            'ELEMENTOS DE FÍSICA',
            'ELEMENTOS DE ESTATÍSTICA',
            'INTRODUÇÃO ÁS ESTRUTURAS ALGÉBRICAS',
            'FUNDAMENTOS PSICOLÓGICOS DA EDUCAÇÃO',
            'FUNDAMENTOS ANTROPOLÓGICOS DA EDUCAÇÃO',
            'FUNDAMENTOS SOCIOLÓGICOS DA EDUCAÇÃO',
            'FUNDAMENTOS FILOSÓFICOS DA EDUCAÇÃO',
            'PROGRESSÕES E MATEMÁTICA FINANCEIRA',
            'CONTAGEM E PROBABILIDADE',
            'INTRODUÇÃO À LÓGICA MATEMÁTICA',
            'EDUCAÇÃO E RELAÇÃO ÉTNICO-RACIAIS',
            'EQUAÇÕES DIFERENCIAIS ORDINÁRIAS',
            'INTRODUÇÃO A TEORIA DOS NÚMEROS',
            'DIDÁTICA',
            'LIBRAS',
            'DIDÁTICA DA MATEMÁTICA',
            'TEORIAS DA APRENDIZAGEM',
            'LINGUA PORTUGUESA',
            'HISTÓRIA DA MATEMÁTICA',
            'ORGANIZAÇÃO DA EDUCAÇÃO NACIONAL',
            'EDUCAÇÃO INCLUSIVA',
            'AVALIAÇÃO DA APRENDIZAGEM',
        ];

        $disciplinas_computacao = [
            'ALGORITMOS E ESTRUTURAS DE DADOS', 
            'PROGRAMAÇÃO I', 
            'PROGRAMAÇÃO II', 
            'PROGRAMAÇÃO III', 
            'PARADIGMAS DE LINGUAGENS DE PROGRAMAÇÃO', 
            'ORGANIZAÇÃO E ARQUITETURA DE COMPUTADORES', 
            'TEORIA DA COMPUTAÇÃO', 
            'INTRODUÇÃO À COMPUTAÇÃO', 
            'ÁLGEBRA LINEAR E GEOMETRIA ANALÍTICA', 
            'CÁLCULO I', 
            'CÁLCULO II', 
            'MATEMÁTICA ELEMENTAR', 
            'MATEMÁTICA DISCRETA', 
            'PROBABILIDADE E ESTATÍSTICA', 
            'FUNDAMENTOS FILOSÓFICOS DA EDUCAÇÃO', 
            'FUNDAMENTOS SOCIOLÓGICOS DA EDUCAÇÃO', 
            'AVALIAÇÃO DA APRENDIZAGEM', 
            'FUNDAMENTOS PSICOLÓGICOS NA EDUCAÇÃO', 
            'ORGANIZAÇÃO DA EDUCAÇÃO NACIONAL', 
            'EDUCAÇÃO INCLUSIVA', 
            'EDUCAÇÃO E RELAÇÕES ÉTNICO-RACIAIS', 
            'DIDÁTICA', 
            'EDUCAÇÃO À DISTÂNCIA', 
            'ENSINO DE COMPUTAÇÃO', 
            'LIBRAS', 
            'LÍNGUA PORTUGUESA NA PRODUÇÃO DE CONHECIMENTO', 
            'METODOLOGIA CIENTÍFICA', 
            'BANCO DE DADOS', 
            'ENGENHARIA DE SOFTWARE', 
            'REDES DE COMPUTADORES', 
            'INTERAÇÃO HUMANO-COMPUTADOR', 
            'TECNOLOGIAS APLICADAS À EDUCAÇÃO', 
            'SISTEMAS OPERACIONAIS', 
            'COMPUTAÇÃO GRÁFICA E SISTEMAS MULTIMÍDIA', 
            'INTELIGÊNCIA ARTIFICIAL', 
            'SEGURANÇA DE SISTEMAS', 
            'COMPUTAÇÃO, ÉTICA E SOCIEDADE', 
            'EMPREENDEDORISMO E INOVAÇÃO', 
            'FUNDAMENTOS ANTROPOLÓGICOS'
        ];

        $disciplinas_geografia = [
            'Geografia EconÔmicA',
            'HistÓria do Pensamento GeogrÁfico',
            'Geologia Geral',
            'LÍngua Portuguesa na produÇÃO do Conhecimento',
            'Fundamentos AntropolÓgicos da EDUCAÇÃO',
            'Cartografia BÁsica',
            'EstatÍstica Aplicada À Geografia',
            'Climatologia',
            'Metodologia CientÍfica',
            'Geografia da PopulaÇÃO',
            'Cartografia TemÁtica',
            'Biogeografia',
            'Geografia Regional do Brasil',
            'Fundamentos SociolÓgicos da EDUCAÇÃO',
            'Fundamentos PsicolÓgicos da EDUCAÇÃO',
            'Geografia dos Setores SecundÁrio e TerciÁrio',
            'IntroduÇÃO À Pedologia e a Edafologia',
            'DidÁtica',
            'Fundamentos FilosÓficos da EDUCAÇÃO',
            'Hidrogeografia',
            'Geomorfologia',
            'Geografia AgrÁria',
            'Geografia Urbana',
            'Sensoriamento Remoto Aplicado À Geografia',
            'ELABORAÇÃO de Projeto de Pesquisa',
            'Geografia Cultural',
            'Geomorfologia Aplicada',
            'Geografia PolÍtica',
            'OrganizaÇÃO da EDUCAÇÃO Nacional',
            'Teorias e MÉtodos em Geografia Humana',
            'DinÂmica e Funcionamento do EspaÇo Mundial',
            'EDUCAÇÃO e RELAÇÕES Étnico-Raciais',
            'AvaliaÇÃO da Aprendizagem',
            'Formação SÓcio-territorial do NE e de PE',
            'EDUCAÇÃO Inclusiva' ,
            'Libras',
            'Geoecologia e Desenvolvimento SustentÁvel',
        ];

        $disciplinas_letras_portugues = [
            'Metodologia CientÍfica',
            'LÍNGUA Portuguesa na ProduÇÃO do Conhecimento',
            'EducaÇÃo Inclusiva',
            'HistÓria da LÍNGUA Portuguesa',
            'Teoria LiterÁria I',
            'Teoria LiterÁria II',
            'LÍNGUA Latina',
            'Literatura Latina',
            'Literatura Portuguesa I',
            'Literatura Portuguesa II',
            'Fundamentos Psicológicos da EducaÇÃO',
            'Fundamentos Sociológicos da EducaÇÃO',
            'LÍbras – LÍNGUA Brasileira de Sinais',
            'Fundamentos AntropolÓgicos da EducaÇÃO',
            'Cultura IndÍgena e EducaÇÃO',
            'FonÉtica e Fonologia da LÍngua Portuguesa',
            'Morfossintaxe I',
            'Morfossintaxe II',
            'Fundamentos FilosÓficos da EducaÇÃO',
            'AvaliaÇÃO da Aprendizagem',
            'Metodologia da Pesquisa I',
            'Literatura Brasileira I',
            'Literatura Brasileira II',
            'Literatura Brasileira III',
            'Literatura Brasileira IV',
            'Literaturas Africanas de LÍNGUA Portuguesa',
            'LinguÍstica Textual',
            'SociolinguÍstica',
            'LinguÍstica I',
            'Literatura e Cultura Afro-Brasileira',
            'LinguÍstica II',
            'SemÂntica e PragmÁtica',
            'AnÁlise do Discurso',
            'EducaÇÃO e RelaÇÃO Étnico-Raciais',
            'OrganizaÇÃO da EducaÇÃO Nacional',
            'DidÁtica',
        ];
        
        $disciplinas_biologia = [
            'Anatomofisiologia Humana',
            'BioestatÍstica',
            'Biofísica',
            'BioquÍmica I',
            'BioquÍmica II',
            'Biotecnologia',
            'BotÂnica SistemÁtica',
            'CitogenÉtica',
            'Citologia',
            'Ecologia',
            'EducaÇÃO Inclusiva',
            'Elementos de Geologia',
            'Embriologia',
            'EVOLUÇÃO',
            'Fisiologia Comparada',
            'Fisiologia Vegetal',
            'Fundamentos SocioantropolÓgicos da EducaÇÃO',
            'GenÉtica BÁsica',
            'GenÉtica MOLECULAR',
            'Histologia',
            'HistÓria da Biologia',
            'Imunologia BÁsica',
            'Introdução À Filosofia das CiÊncias',
            'LÍngua Brasileira de Sinais – LIBRAS',
            'Metodologia CientÍfica',
            'Metodologia do Ensino de Biologia',
            'Metodologia do Ensino de CiÊncias',
            'Micologia',
            'Microbiologia',
            'Morfo-Anatomia Vegetal',
            'Novas Tecnologias Aplicadas ao Ensino de Biologia',
            'Parasitologia',
            'PrÁtica de LaboratÓrio',
            'Protista',
            'Psicologia da Aprendizagem',
            'Psicologia do Desenvolvimento',
            'QuÍmica Geral',
            'QuÍmica OrgÂnica',
            'SaÚde PÚblica',
            'Zoologia dos Cordados',
            'Zoologia dos Invertebrados Inferiores',
            'Zoologia dos Invertebrados Superiores',
        ];

        $disciplinas_pedagogia = [
            'LÍngua Portuguesa na ProduÇÃO de Conhecimento',
            'Fundamentos AntropolÓgicos da EducaÇÃO',
            'Fundamentos SociolÓgicos da EducaÇÃO',
            'Fundamentos FilosÓficos da EducaÇÃO',
            'Fundamentos HistÓricos da EducaÇÃO',
            'HistÓria da EducaÇÃO Brasileira',
            'Fundamentos PsicolÓgicos da EducaÇÃO',
            'Fundamentos da EducaÇÃO Infantil',
            'Metodologia CientÍfica',
            'DidÁtica',
            'OrganizaÇÃO da EducaÇÃO Nacional',
            'Pesquisa em EducaÇÃO I',
            'Arte e EducaÇÃO',
            'Ética Profissional',
            'EducaÇÃO Inclusiva',
            'Fundamentos da EducaÇÃO Especial',
            'Planejamento EducacionaL',
            'ConteÚdos, Metodologias e PrÁticas Docentes da EducaÇÃO Infantil',
            'ConteÚdos, Metodologias e PrÁticas Docentes do Ensino de MatemÁtica',
            'ConteÚdos, Metodologias e PrÁticas Docentes do Ensino da LÍngua Portuguesa',
            'ConteÚdos, Metodologias e PrÁticas Docentes do Ensino de CiÊncias Naturais',
            'ConteÚdos, Metodologias e PrÁticas Docentes do Ensino de HistÓria',
            'ConteÚdos, Metodologias e PrÁticas Docentes do Ensino de Geografia',
            'AlfabetizaÇÃO e Letramento',
            'CurrÍculo e Contemporaneidade',
            'EducaÇÃO de Jovens Adultos e Idoso',
            'AVALIAÇÃO da Aprendizagem',
            'Tecnologias e EDUCAÇÃO',
            'LIBRAS',
            'Pedagogia em EspaÇos NÃO Escolares',
            'FormaÇÃO e ProfissionalizaÇÃO Docente',
            'EducaÇÃO do Campo',
            'Psicologia da Aprendizagem',
            'Financiamento da EducaÇÃO',
            'Literatura Infanto-Juvenil',
            'Pesquisa em EducaÇÃO II',
            'Psicologia do Desenvolvimento',
            'Coordenação PedagÓgica',
            'GestÃO Educacional',
            'GestÃO Escolar',
            'EDUCAÇÃO E RELAÇÕES Étnico-Raciais',
            'RelaÇÕES interpessoais e dinÂmica de grupo'
        ];

        $disciplinas_historia = [
            'ANTIGUIDADE CLÁSSICA',
            'ANTROPOLOGIA CULTURAL',
            'ANTIGUIDADE PRÉ-CLÁSSICA',
            'AVALIAÇÃO DA APRENDIZAGEM',
            'ARQUEOLOGIA, PATRIMÔNIO E CULTURA',
            'DIDÁTICA GERAL',
            'EDUCAÇÃO INCLUSIVA',
            'EDUCAÇÃO E CULTURA HISTÓRICA',
            'EDUCAÇÃO E RELAÇÕES ÉTNICO-RACIAIS',
            'EDUCAÇÃO PARA AS RELAÇÕES DE TRABALHO NO BRASIL',
            'FILOSOFIA DA HISTÓRIA',
            'FUNDAMENTOS FILOSÓFICOS DA EDUCAÇÃO',
            'FUNDAMENTOS PSICOLÓGICOS DA EDUCAÇÃO',
            'FUNDAMENTOS SOCIOLÓGICOS DA EDUCAÇÃO',
            'FUNDAMENTOS ANTROPOLÓGICOS DA EDUCAÇÃO',
            'HISTORIOGRAFIA',
            'HISTÓRIA DA ÁFRICA',
            'HISTÓRIA MODERNA I',
            'HISTÓRIA MODERNA II',
            'HISTÓRIA DO BRASIL I',
            'HISTÓRIA DO BRASIL II',
            'HISTÓRIA DO BRASIL III',
            'HISTÓRIA DO BRASIL IV',
            'HISTÓRIA DA AMÉRICA I',
            'HISTÓRIA DA AMÉRICA II',
            'HISTÓRIA CONTEMPORÂNEA I',
            'HISTÓRIA CONTEMPORÂNEA II',
            'HISTORIOGRAFIA DO NORDESTE',
            'HISTÓRIA DO TEMPO PRESENTE',
            'HISTÓRIA DA AMÉRICA INDÍGENA',
            'HISTÓRIA MEDIEVAL I (ORIENTAL)',
            'HISTÓRIA MEDIEVAL II (OCIDENTAL)',
            'INTRODUÇÃO AOS ESTUDOS HISTÓRICOS',
            'METODOLOGIA E PESQUISA EM HISTÓRIA',
            'ORGANIZAÇÃO DA EDUCAÇÃO NACIONAL',
            'TEORIA DA HISTÓRIA I',
            'TEORIA DA HISTÓRIA II',
            'TÓPICOS ESPECIAIS DE HISTÓRIA DE PERNAMBUCO',
            'PRÉ-HISTÓRIA',
            'PSICOLOGIA EVOLUTIVA',
            'LIBRAS',
            'LÍNGUA PORTUGUESA NA PRODUÇÃO DE CONHECIMENTOS'
        ];
        
        $disciplinas_eng_computacao = [
            "COMPILADORES",
            "TEORIA DA COMPUTAÇÃO",
            "ALGORITMOS E ESTRUTURAS DE DADOS",
            "FUNDAMENTOS DE PROGRAMAÇÃO",
            "PROGRAMAÇÃO IMPERATIVA",
            "LINGUAGEM DE PROGRAMAÇÃO ORIENTADA OBJETOS",
            "ENGENHARIA DE SOFTWARE",
            "BANCO DE DADOS",
            "INTELIGÊNCIA ARTIFICIAL E COMPUTACIONAL",
            "APRENDIZAGEM DE MÁQUINA",
            "SISTEMAS MULTIMÍDIA",
            "PROCESSAMENTO DIGITAL DE IMAGENS",
            "INTERFACE HUMANO-COMPUTADOR",
            "INFORMÁTICA, ECONOMIA E SOCIEDADE",
            "SISTEMAS OPERACIONAIS",
            "ARQUITETURA DE COMPUTADORES",
            "ORGANIZAÇÃO DE COMPUTADORES",
            "LÓGICA",
            "MATEMÁTICA DISCRETA",
            "PROBABILIDADE E ESTATÍSTICA",
            "TEORIA DOS GRAFOS",
            "PESQUISA OPERACIONAL",
            "ELETRÔNICA DIGITAL",
            "CIRCUITOS ELÉTRICOS",
            "ELETRÔNICA PARA COMPUTAÇÃO",
            "MATERIAIS E DISPOSITIVOS SEMICONDUTORES",
            "SISTEMAS EMBARCADOS",
            "SINAIS E SISTEMAS",
            "AUTOMAÇÃO INDUSTRIAL",
            "CONTROLE DE PROCESSOS",
            "REDES DE COMPUTADORES I",
            "REDES DE COMPUTADORES II",
            "SISTEMAS DE COMUNICAÇÃO",
            "ELETROMAGNETISMO",
        ];
        
        foreach($disciplinas_matematica as $disciplina) {
            // DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $matematica_garanhuns]);
        }

        foreach($disciplinas_computacao as $disciplina) {
            // DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $computacao_garanhuns]);
        }

        foreach($disciplinas_geografia as $disciplina) {
            // DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $geografia_garanhuns]);
        }

        foreach($disciplinas_historia as $disciplina) {
            DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $historia_garanhuns]);
        }

        foreach($disciplinas_letras_portugues as $disciplina) {
            // DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $letras_portugues_garanhuns]);
        }

        foreach($disciplinas_biologia as $disciplina) {
            // DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $biologicas_garanhuns]);
        }

        foreach($disciplinas_pedagogia as $disciplina) {
            // DB::table('disciplinas')->insert(['nome' => strtoupper($disciplina), 'curso_id' => $pedagogia_garanhuns]);
        }
        
    }
}
