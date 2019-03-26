<?php

namespace SimuladoENADE\Http\Controllers;

use Illuminate\Http\Request;
use SimuladoENADE\Validator\CsvImportRequest;
use SimuladoENADE\Http\Aluno;
use Illuminate\Support\Facades\Hash;
use SimuladoENADE\Validator\ValidationException;
use SimuladoENADE\Validator\AlunoValidator; 

class ImportController extends Controller
{
    //


    public function getImport()
    {
        return view('import');
    }



    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        #dd($data);
        if(($data)==null){ dd("Arquivo vazio");  }
        else{



        $csv_data = array_slice($data, 0, count($data));
        foreach ($csv_data as $input) {

            if($input[0] and $input[1] and $input[2] and $input[3]){

                $curso_id = \Auth::user()->curso_id;
                $aluno = new \SimuladoENADE\Aluno();
                $aluno->nome = $input[0];
                $aluno->cpf = $input[1];
                $aluno->email = $input[2];

                $aluno->curso_id = $curso_id;
                $aluno->password = Hash::make($input[3]);
                $aluno->save();

                
            }
            else{
                ##Relatar uma view de erro para algum campo vazio
            }


        }
        return redirect('listar/aluno');

    }
        

    }
}

