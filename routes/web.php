<?php
use Illuminate\Http\Request;
use App\Curso;
use App\Usuario;
use App\Disciplina;
use App\Questao;
use App\Aluno;
use App\Turma;
use App\Simulado;
use App\Http\Middleware\AdministradorMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function(){
	Route::get('/', function () {
	    return view('welcome');
});

Route::get('/listar/simulado', 'SimuladoController@listar');
		
Route::middleware('coordenador.auth')->group(function(){

	//Usar duplicaçãpo de rotas
		
		Route::get('/listar/disciplina','DisciplinaController@listar');
		Route::get('/cadastrar/disciplina','DisciplinaController@cadastrar');
		Route::post('/adicionar/disciplina','DisciplinaController@adicionar');
		Route::get('/editar/disciplina/{id}','DisciplinaController@editar');
		Route::post('/atualizar/disciplina','DisciplinaController@atualizar');
		Route::get('/remover/disciplina/{id}','DisciplinaController@remover');

		Route::get('/listar/aluno', 'AlunoController@listar');
		Route::get('/cadastrar/aluno', 'AlunoController@cadastrar');
		Route::post('/adicionar/aluno', 'AlunoController@adicionar');
		Route::get('/editar/aluno/{id}', 'AlunoController@editar');
		Route::post('/atualizar/aluno', 'AlunoController@atualizar');
		Route::get('/remover/aluno/{id}', 'AlunoController@remover');

		Route::get('/listar/professor', 'Usuariocontroller@listar');
		Route::get('/cadastrar/professor', 'Usuariocontroller@cadastrar');
		Route::post('/adicionar/professor', 'Usuariocontroller@adicionar');
		Route::get('/editar/professor/{id}', 'Usuariocontroller@editar');
		Route::post('/atualizar/professor', 'Usuariocontroller@atualizar');
		Route::get('/remover/professor/{id}', 'Usuariocontroller@remover');

		Route::get('/cadastrar/simulado', 'SimuladoController@cadastrar');
		Route::post('/adicionar/simulado', 'SimuladoController@adicionar');
		Route::get('/editar/simulado/{id}', 'SimuladoController@editar');
		Route::post('/atualizar/simulado', 'SimuladoController@atualizar');
		Route::get('/remover/simulado/{id}', 'SimuladoController@remover');
		Route::get('/montar/simulado/{id}', 'SimuladoController@montar');
		Route::post('/cadastrarQuestao/simulado', 'SimuladoController@cadastrarQuestao');





		Route::get('/listar/questaoCoordenador', 'QuestaoController@listar');
		Route::get('/cadastrar/questaoCoordenador', 'QuestaoController@cadastrar');
		Route::post('/adicionar/questaoCoordenador', 'QuestaoController@adicionar');
		Route::get('/editar/questaoCoordenador/{id}', 'QuestaoController@editar');
		Route::post('/atualizar/questaoCoordenador', 'QuestaoController@atualizar');
		Route::get('/remover/questaoCoordenador/{id}', 'QuestaoController@remover');


		/*
		Route::get('/listar/questao', 'QuestaoController@listar');
		Route::get('/cadastrar/questao', 'QuestaoController@cadastrar');
		Route::post('/adicionar/questao', 'QuestaoController@adicionar');
		Route::get('/editar/questao/{id}', 'QuestaoController@editar');
		Route::post('/atualizar/questao', 'QuestaoController@atualizar');
		Route::get('/remover/questao/{id}', 'QuestaoController@remover');
		Route::get('/listar/usuario', 'Usuariocontroller@listar');
		Route::get('/cadastrar/usuario', 'Usuariocontroller@cadastrar');
		Route::post('/adicionar/usuario', 'Usuariocontroller@adicionar');
		Route::get('/editar/usuario/{id}', 'Usuariocontroller@editar');
		Route::post('/atualizar/usuario', 'Usuariocontroller@atualizar');
		Route::get('/remover/usuario/{id}', 'Usuariocontroller@remover');
		Route::get('/listar/aluno', 'AlunoController@listar');
		Route::get('/cadastrar/aluno', 'AlunoController@cadastrar');
		Route::post('/adicionar/aluno', 'AlunoController@adicionar');
		Route::get('/editar/aluno/{id}', 'AlunoController@editar');
		Route::post('/atualizar/aluno', 'AlunoController@atualizar');
		Route::get('/remover/aluno/{id}', 'AlunoController@remover');
		Route::get('/cadastrar/simulado', 'SimuladoController@cadastrar');
		Route::post('/adicionar/simulado', 'SimuladoController@adicionar');
		Route::get('/editar/simulado/{id}', 'SimuladoController@editar');
		Route::post('/atualizar/simulado', 'SimuladoController@atualizar');
		Route::get('/remover/simulado/{id}', 'SimuladoController@remover');
		Route::get('/montar/simulado/{id}', 'SimuladoController@montar');
		Route::post('/cadastrarQuestao/simulado', 'SimuladoController@cadastrarQuestao');
		Route::get('/listar/disciplina','DisciplinaController@listar');
		Route::get('/cadastrar/disciplina','DisciplinaController@cadastrar');
		Route::post('/adicionar/disciplina','DisciplinaController@adicionar');
		Route::get('/editar/disciplina/{id}','DisciplinaController@editar');
		Route::post('/atualizar/disciplina','DisciplinaController@atualizar');
		Route::get('/remover/disciplina/{id}','DisciplinaController@remover');
		Route::get('/listar/curso','Cursocontroller@listar');
		Route::post('/adicionar/curso','Cursocontroller@adicionar');
		Route::get('/cadastrar/curso', 'Cursocontroller@cadastrar');
		Route::get('/editar/curso/{id}', 'Cursocontroller@editar');
		Route::get('/remover/curso/{id}', 'Cursocontroller@remover');
		Route::post('/atualizar/curso','Cursocontroller@atualizar');
		Route::get('/remover/simulado/{id}', 'SimuladoController@remover');
		Route::get('/montar/simulado/{id}', 'SimuladoController@montar');
		Route::post('/cadastrarQuestao/simulado', 'SimuladoController@cadastrarQuestao');
		//Route::get('/questao/simulado/{id}', 'SimuladoController@questao');
		//Route::post('/responder/simulado/', 'SimuladoController@responder');
		//Route::get('/resultado/simulado/{id}', 'SimuladoController@resultado');*/
	});
	Route::middleware('professor.auth')->group(function(){

		Route::get('/listar/questao', 'QuestaoController@listar');
		Route::get('/cadastrar/questao', 'QuestaoController@cadastrar');
		Route::post('/adicionar/questao', 'QuestaoController@adicionar');
		Route::get('/editar/questao/{id}', 'QuestaoController@editar');
		Route::post('/atualizar/questao', 'QuestaoController@atualizar');
		Route::get('/remover/questao/{id}', 'QuestaoController@remover');


	
		//Route::get('/questao/simulado/{id}', 'SimuladoController@questao');
		//Route::post('/responder/simulado/', 'SimuladoController@responder');
		//Route::get('/resultado/simulado/{id}', 'SimuladoController@resultado');


		Route::get('/cadastrar/questaosimulado','QuestaoSimuladoController@cadastrar');
		Route::post('/adicionar/questaosimulado','QuestaoSimuladoController@adicionar');
		Route::get('/editar/questaosimulado/{id}','QuestaoSimuladoController@editar');
		Route::post('/atualizar/questaosimulado','QuestaoSimuladoController@atualizar');
		Route::get('/remover/questaosimulado/{id}','QuestaoSimuladoController@remover');
		
	});
	Route::middleware('adm.auth')->group(function(){


		Route::get('/listar/curso','Cursocontroller@listar');
		Route::post('/adicionar/curso','Cursocontroller@adicionar');
		Route::get('/cadastrar/curso', 'Cursocontroller@cadastrar');
		Route::get('/editar/curso/{id}', 'Cursocontroller@editar');
		Route::get('/remover/curso/{id}', 'Cursocontroller@remover');
		Route::post('/atualizar/curso','Cursocontroller@atualizar');

		Route::get('/listar/usuario', 'Usuariocontroller@listar');
		Route::get('/cadastrar/usuario', 'Usuariocontroller@cadastrar');
		Route::post('/adicionar/usuario', 'Usuariocontroller@adicionar');
		Route::get('/editar/usuario/{id}', 'Usuariocontroller@editar');
		Route::post('/atualizar/usuario', 'Usuariocontroller@atualizar');
		Route::get('/remover/usuario/{id}', 'Usuariocontroller@remover');

		Route::get('/listar/ciclo', 'Ciclocontroller@listar');
		Route::get('/cadastrar/ciclo', 'Ciclocontroller@cadastrar');
		Route::post('/adicionar/ciclo', 'Ciclocontroller@adicionar');
		Route::get('/editar/ciclo/{id}', 'Ciclocontroller@editar');
		Route::post('/atualizar/ciclo', 'Ciclocontroller@atualizar');
		Route::get('/remover/ciclo/{id}', 'Ciclocontroller@remover');

		//Rotas Alternativas 

		/*Route::get('/listar/disciplina','DisciplinaController@listar');
		Route::get('/cadastrar/disciplina','DisciplinaController@cadastrar');
		Route::post('/adicionar/disciplina','DisciplinaController@adicionar');
		Route::get('/editar/disciplina/{id}','DisciplinaController@editar');
		Route::post('/atualizar/disciplina','DisciplinaController@atualizar');
		Route::get('/remover/disciplina/{id}','DisciplinaController@remover');
		Route::get('/listar/curso','Cursocontroller@listar');
		Route::post('/adicionar/curso','Cursocontroller@adicionar');
		Route::get('/cadastrar/curso', 'Cursocontroller@cadastrar');
		Route::get('/editar/curso/{id}', 'Cursocontroller@editar');
		Route::get('/remover/curso/{id}', 'Cursocontroller@remover');
		Route::post('/atualizar/curso','Cursocontroller@atualizar');
		Route::get('/listar/ciclo', 'Ciclocontroller@listar');
		Route::get('/cadastrar/ciclo', 'Ciclocontroller@cadastrar');
		Route::post('/adicionar/ciclo', 'Ciclocontroller@adicionar');
		Route::get('/editar/ciclo/{id}', 'Ciclocontroller@editar');
		Route::post('/atualizar/ciclo', 'Ciclocontroller@atualizar');
		Route::get('/remover/ciclo/{id}', 'Ciclocontroller@remover');
		Route::get('/listar/questao', 'QuestaoController@listar');
		Route::get('/cadastrar/questao', 'QuestaoController@cadastrar');
		Route::post('/adicionar/questao', 'QuestaoController@adicionar');
		Route::get('/editar/questao/{id}', 'QuestaoController@editar');
		Route::post('/atualizar/questao', 'QuestaoController@atualizar');
		Route::get('/remover/questao/{id}', 'QuestaoController@remover');
		Route::get('/listar/usuario', 'Usuariocontroller@listar');
		Route::get('/cadastrar/usuario', 'Usuariocontroller@cadastrar');
		Route::post('/adicionar/usuario', 'Usuariocontroller@adicionar');
		Route::get('/editar/usuario/{id}', 'Usuariocontroller@editar');
		Route::post('/atualizar/usuario', 'Usuariocontroller@atualizar');
		Route::get('/remover/usuario/{id}', 'Usuariocontroller@remover');
		Route::get('/listar/aluno', 'AlunoController@listar');
		Route::get('/cadastrar/aluno', 'AlunoController@cadastrar');
		Route::post('/adicionar/aluno', 'AlunoController@adicionar');
		Route::get('/editar/aluno/{id}', 'AlunoController@editar');
		Route::post('/atualizar/aluno', 'AlunoController@atualizar');
		Route::get('/remover/aluno/{id}', 'AlunoController@remover');
		//Route::get('/listar/simulado', 'SimuladoController@listar');
		Route::get('/cadastrar/simulado', 'SimuladoController@cadastrar');
		Route::post('/adicionar/simulado', 'SimuladoController@adicionar');
		Route::get('/editar/simulado/{id}', 'SimuladoController@editar');
		Route::post('/atualizar/simulado', 'SimuladoController@atualizar');
		Route::get('/remover/simulado/{id}', 'SimuladoController@remover');
		Route::get('/montar/simulado/{id}', 'SimuladoController@montar');
		Route::post('/cadastrarQuestao/simulado', 'SimuladoController@cadastrarQuestao');
		Route::get('/remover/simulado/{id}', 'SimuladoController@remover');
		Route::get('/montar/simulado/{id}', 'SimuladoController@montar');
		Route::post('/cadastrarQuestao/simulado', 'SimuladoController@cadastrarQuestao');
		//Route::get('/questao/simulado/{id}', 'SimuladoController@questao');
		//Route::post('/responder/simulado/', 'SimuladoController@responder');
		//Route::get('/resultado/simulado/{id}', 'SimuladoController@resultado');*/
	});
	Route::middleware('aluno.auth')->group(function(){
		//Route::get('teste11', function () {
	    //return view('welcome');
//});
		//Route::post('/responder/simulado/', 'SimuladoController@responder');
		//Route::get('/resultado/simulado/{id}', 'SimuladoController@resultado');
		
	});
	Route::get('/questao/simulado/{id}', 'SimuladoController@questao');
});

Route::middleware('aluno.auth')->group(function(){


	route::get('/listaSimuladoAluno/simulado', 'SimuladoController@listaSimuladoAluno');
	Route::get('/questao/simulado/{id}', 'SimuladoController@questao');
	Route::post('/responder/simulado/', 'SimuladoController@responder');
	Route::get('/resultado/simulado/{id}', 'SimuladoController@resultado');
		});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/listar/turma','TurmaController@listar');
Route::get('/cadastrar/turma','TurmaController@cadastrar');
Route::post('/adicionar/turma','TurmaController@adicionar');
Route::get('/editar/turma/{id}','TurmaController@editar');
Route::post('/atualizar/turma','TurmaController@atualizar');
Route::get('/remover/turma/{id}','TurmaController@remover');
Route::get('/listar/resposta','RespostaController@listar');
Route::get('/cadastrar/resposta','RespostaController@cadastrar');
Route::post('/adicionar/resposta','RespostaController@adicionar');
Route::get('/editar/resposta/{id}','RespostaController@editar');
Route::post('/atualizar/resposta','RespostaController@atualizar');
Route::get('/remover/resposta/{id}','RespostaController@remover');
Route::get('/listar/simuladoaluno','SimuladoAlunoController@listar');
Route::get('/cadastrar/simuladoaluno','SimuladoAlunoController@cadastrar');
Route::post('/adicionar/simuladoaluno','SimuladoAlunoController@adicionar');
Route::get('/editar/simuladoaluno/{id}','SimuladoAlunoController@editar');
Route::post('/atualizar/simuladoaluno','SimuladoAlunoController@atualizar');
Route::get('/remover/simuladoaluno/{id}','SimuladoAlunoController@remover');
Route::get('/listar/questaosimulado','QuestaoSimuladoController@listar');
Route::get('/cadastrar/questaosimulado','QuestaoSimuladoController@cadastrar');
Route::post('/adicionar/questaosimulado','QuestaoSimuladoController@adicionar');
Route::get('/editar/questaosimulado/{id}','QuestaoSimuladoController@editar');
Route::post('/atualizar/questaosimulado','QuestaoSimuladoController@atualizar');
Route::get('/remover/questaosimulado/{id}','QuestaoSimuladoController@remover');