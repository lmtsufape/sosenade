<?php

namespace SimuladoENADE\Console\Commands;

use Illuminate\Console\Command;
use SimuladoENADE\Questao;

class ImportarQuestoesZootecniaMoodle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:questoeszootecnia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa as questões de Zootecnia exportadas do Moodle';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alternativas = [
            '0' => 'alternativa_a',
            '1' => 'alternativa_b',
            '2' => 'alternativa_c',
            '3' => 'alternativa_d',
            '4' => 'alternativa_e',
        ];
        $path = storage_path('app/questionario-COORDENAÇÃO DO CURSO (46)-Componente EspecíficoObjetivas-20221108-0836.xml');
        $xml = simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        foreach ($array['question'] as $key => $value) {
            if ($value['@attributes']['type'] == 'multichoice') {
                if (array_key_exists('file', $value['questiontext'])) {
                    if (is_array($value['questiontext']['file'])) {
                        foreach ($value['questiontext']['file'] as $i => $valor) {
                            $value['questiontext']['text'] = preg_replace('/"@@PLUGINFILE@@\/.*\.([a-z][A-Z]*)"/i', '"data:image/$1;base64,'.$value['questiontext']['file'][$i].'"', $value['questiontext']['text'], 1);
                        }
                    } else {
                        $value['questiontext']['text'] = preg_replace('/"@@PLUGINFILE@@\/.*\.([a-z][A-Z]*)"/i', '"data:image/$1;base64,'.$value['questiontext']['file'].'"', $value['questiontext']['text']);
                    }
                }
                $questao = new Questao([
                    'enunciado' => $value['questiontext']['text'],
                    'dificuldade' => intval($value['defaultgrade']),
                    'disciplina_id' => 1,
                ]);
                foreach ($value['answer'] as $n => $val) {
                    $questao->{$alternativas[$n]} = $val['text'];
                    if ($val['@attributes']['fraction'] == '100') {
                        $questao->alternativa_correta = $n;
                    }
                }
                $questao->save();
            }
        }
    }
}
