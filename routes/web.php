<?php

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

 // Route::get('/', function () {
 //     return view('welcome');
 // });

Route::Auth();

Route::get('/',[ 'as'=>'home', 'uses' => 'HomeController@index', 'middleware' => ['auth', 'acl']]);
// Route::get('/turmas/show', 'TurmasController@show');
// Route::get('chart', 'TurmasController@chart');
// Route::get('components', 'TurmasController@components');

//Usuarios
Route::group(['as'=>'users.', 'prefix'=>'users', 'middleware'=>['auth','acl']], function(){
  Route::get('create', ['as'=>'create','uses'=>'UsersController@create', 'can'=>'create.user']);
  Route::post('store',['as'=>'store', 'uses'=>'UsersController@store', 'can'=>'create.user']);
  Route::get('', ['as'=>'index', 'uses'=>'UsersController@index','can'=>'view.user']);
  Route::get('{id}/edit', ['as'=>'edit', 'uses'=>'UsersController@edit','can'=>'update.user']);
  Route::put('{id}/update', ['as'=>'update', 'uses'=>'UsersController@update','can'=>'update.user']);
  Route::get('{id}/destroy', ['as'=>'destroy', 'uses'=>'UsersController@destroy','can'=>'delete.user']);
});

//Turmas
Route::group(['as'=>'turmas.', 'prefix'=>'turmas','middleware'=>['auth','acl']], function(){
  Route::get('',['as'=>'index', 'uses'=>'TurmasController@index', 'can'=>'view.turma']);
  Route::get('atrasadosPdf',['as'=>'atrasadosPdf', 'uses'=>'TurmasController@atrasadosPdf','can'=>'view.turma']);
});

//Indisciplinas
Route::group(['as'=>'ocorrencias.', 'prefix'=>'ocorrencias','middleware'=>['auth','acl']], function(){
  Route::get('',['as'=>'index', 'uses'=>'OcorrenciasController@index', 'can'=>'create.disciplinar']);
  Route::post('indisciplinas/store', ['as'=>'indisciplinas.store', 'uses'=>'IndisciplinasController@store', 'can'=>'create.disciplinar']);
  Route::post('store',['as'=>'store', 'uses'=>'OcorrenciasController@store', 'can'=>'create.disciplinar']);
  Route::get('{ocorrencia}/edit', ['as'=>'edit', 'uses'=>'OcorrenciasController@edit','can'=>'update.disciplinar']);
  Route::put('{ocorrencia}/update', ['as'=>'update', 'uses'=>'OcorrenciasController@update', 'can'=>'update.disciplinar']);
  Route::get('{ocorrencia}/print', ['as'=>'print', 'uses'=>'OcorrenciasController@print', 'can'=>'view.disciplinar']);
  Route::get('relatorio', ['as'=>'relatorio', 'uses'=>'OcorrenciasController@relatorio', 'can'=>'view.disciplinar']);
});

//Servidores
Route::group(['as'=>'empregados.', 'prefix'=>'empregados','middleware'=>['auth','acl']], function(){
  Route::get('', ['as'=>'index', 'uses'=>'EmpregadosController@index', 'can'=>'view.servidor']);
  Route::get('apiServidor', ['as'=>'apiServidor', 'uses'=>'EmpregadosController@apiServidor','can'=>'view.servidor']);
  Route::get('apiEquipe', ['as'=>'apiEquipe', 'uses'=>'EmpregadosController@apiEquipe','can'=>'view.servidor']);
  Route::get('apiProfessor', ['as'=>'apiProfessor', 'uses'=>'EmpregadosController@apiProfessor','can'=>'view.servidor']);
  Route::get('{empregado}/show', ['as'=>'show', 'uses'=>'EmpregadosController@show', 'is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/status',['as'=>'status', 'uses'=>'EmpregadosController@status','is'=>'administrador|diretor|administrativo']);
  Route::get('create', ['as'=>'create','uses'=>'EmpregadosController@create','is'=>'administrador|diretor|administrativo']);
  Route::post('store',['as'=>'store', 'uses'=>'EmpregadosController@store', 'is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/edit',['as'=>'edit','uses'=>'EmpregadosController@edit', 'is'=>'administrador|diretor|administrativo']);
  Route::put('{empregado}/update',['as'=>'update', 'uses' => 'EmpregadosController@update', 'is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/namo', ['as'=>'namo','uses'=>'EmpregadosController@namo','can'=>'view.servidor']);
  Route::post('{empregado}/ponto',['as'=>'ponto', 'uses'=>'EmpregadosController@ponto','is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/avalia',['as'=>'avalia', 'uses'=>'EmpregadosController@avalia','is'=>'administrador|diretor|administrativo']);
});

//Equipe
Route::group(['as'=>'equipes.','prefix'=>'equipes','middleware'=>['auth','acl']], function(){
  Route::get('',['as'=>'index', 'uses'=>'EquipesController@index','is'=>'administrador|diretor|administrativo']);
  Route::get('{equipe}/edit', ['as'=>'edit', 'uses'=>'EquipesController@edit','is'=>'administrador|diretor|administrativo']);
  Route::put('{equipe}/update',['as'=>'update', 'uses' => 'EquipesController@update', 'is'=>'administrador|diretor|administrativo']);

});

//Horario
Route::group(['as'=>'horarios.','prefix'=>'horarios','middleware'=>['auth','acl']], function(){
  Route::get('cargas', ['as'=>'cargas.index', 'uses'=>'CargasController@index', 'can'=>'view.turma']);
  Route::get('cargas/teste', ['as'=>'cargas.teste', 'uses'=>'CargasController@teste', 'can'=>'view.turma']);
  Route::post('cargas/store',['as'=>'cargas.store', 'uses'=>'CargasController@store', 'is'=>'administrador|diretor|administrativo']);
  Route::get('cargas/{carga}/edit', ['as'=>'cargas.edit', 'uses'=>'CargasController@edit', 'is'=>'administrador|diretor|administrativo']);
  Route::put('cargas/{carga}/update', ['as'=>'cargas.update', 'uses'=>'CargasController@update', 'is'=>'administrador|diretor|administrativo']);
  Route::get('professors', ['as'=>'professors.index', 'uses'=>'ProfessorsController@index', 'can'=>'view.turma']);
  Route::post('professors/store',['as'=>'professors.store', 'uses'=>'ProfessorsController@store', 'is'=>'administrador|diretor|administrativo']);
  Route::get('apiProfessor', ['as'=>'apiProfessor', 'uses'=>'ProfessorsController@apiProfessor','can'=>'view.servidor']);
  Route::get('disciplinas', ['as'=>'disciplinas.index', 'uses'=>'DisciplinasController@index', 'can'=>'view.turma']);
  Route::post('disciplinas/store',['as'=>'disciplinas.store', 'uses'=>'DisciplinasController@store', 'is'=>'administrador|diretor|administrativo']);
  Route::get('disciplinas/{disciplina}/edit',['as'=>'disciplinas.edit','uses'=>'DisciplinasController@edit', 'is'=>'administrador|diretor|administrativo']);
  Route::put('disciplinas/{disciplina}/update',['as'=>'disciplinas.update','uses'=>'DisciplinasController@update', 'is'=>'administrador|diretor|administrativo']);
  Route::get('create', ['as'=>'create', 'uses'=>'HorariosController@create', 'can'=>'create.turma']);
  Route::post('store',['as'=>'store', 'uses'=>'HorariosController@store','can'=>'create.turma']);
  Route::get('',['as'=>'index','uses'=>'HorariosController@index', 'can'=>'view.turma']);
  Route::get('turma_disciplinas', ['as'=>'turma_disciplinas', 'uses'=>'HorariosController@apiTurmaDisciplina', 'can'=>'view.turma']);
  Route::get('api_horario', ['as'=>'api_horario', 'uses'=>'HorariosController@apiHorario', 'can'=>'view.turma']);
  Route::get('api_professor_horario', ['as'=>'api_professor_horario', 'uses'=>'HorariosController@apiProfessorHorario', 'can'=>'view.turma']);
  Route::get('impressao', ['as'=>'impressao', 'uses'=>'HorariosController@impressao', 'can'=>'view.turma']);
  // Route::get('teste', ['as'=>'teste', 'uses'=>'HorariosController@teste', 'can'=>'view.turma']);
});

//alunos
Route::group(['as'=>'alunos.', 'prefix'=>'alunos', 'middleware'=>['auth','acl']], function(){
  Route::get('apiSelectAluno', ['as'=>'apiSelectAluno','uses'=>'AlunosController@apiSelectAluno', 'can'=>'view.aluno']);
  Route::get('', ['as'=>'index', 'uses'=>'AlunosController@index', 'can'=>'view.aluno']);
  Route::get('create', ['as'=>'create', 'uses'=>'AlunosController@create', 'can'=>'create.aluno']);
  Route::post('store', ['as'=>'store', 'uses'=>'AlunosController@store', 'can'=>'create.aluno']);
  Route::get('{aluno}/edit', ['as'=>'edit', 'uses'=>'AlunosController@edit', 'can'=>'update.aluno']);
  Route::put('{aluno}/update', ['as'=>'edit', 'uses'=>'AlunosController@update', 'can'=>'update.aluno']);
  Route::get('{aluno}/show', ['as'=>'show', 'uses'=>'AlunosController@show', 'can'=>'view.aluno']);
  Route::get('fileTeste', ['as'=>'fileTeste', 'uses'=>'AlunosController@fileTeste','is'=>'administrador']);
  Route::post('fileTesteStore', ['as'=>'fileTesteStore', 'uses'=>'AlunosController@fileTesteStore', 'is'=>'administrador']);
  Route::post('fileTesteNovo', ['as'=>'fileTesteNovo', 'uses'=>'AlunosController@fileTesteNovo', 'is'=>'administrador']);
  Route::get('{aluno}/relatorio', ['as'=>'relatorio', 'uses'=>'AlunosController@relatorio', 'can'=>'view.aluno']);
});

//Rendimento
Route::group(['as'=>'rendimentos.', 'prefix'=> 'rendimentos', 'middleware' =>['auth', 'acl']], function(){
  Route::get('create', ['as'=>'create', 'uses'=>'RendimentosController@create', 'can'=>'create.aluno']);
  Route::post('store', ['as'=>'store', 'uses'=>'RendimentosController@store', 'can'=>'create.aluno']);
  Route::get('', ['as'=>'index', 'uses'=>'RendimentosController@index', 'can'=>'view.aluno']);
});

//Professor
Route::group(['as'=>'professor.','prefix'=>'professor', 'middleware' => ['auth', 'acl']], function(){
  Route::get('', ['as'=>'index', 'uses'=>'ProfessorsController@professor', 'is'=>'professor']);
  Route::get('turma', ['as'=>'turma', 'uses'=>'ReagrupamentosController@turma', 'is'=>'professor']);
  Route::get('{reagrupamento}/reagrupar', ['as'=>'reagrupar', 'uses'=>'ReagrupamentosController@reagrupar', 'is'=>'professor']);
  Route::get('horario', ['as'=>'horario', 'uses'=>'ProfessorsController@horario', 'is'=>'professor']);
  Route::get('turmas', ['as'=>'turmas', 'uses'=>'ProfessorsController@turmas', 'is'=>'professor']);
  Route::get('{turma}/showturma', ['as'=>'showturma', 'uses'=>'ProfessorsController@showturma', 'is'=>'professor']);
  Route::get('relatorio', ['as'=>'relatorio', 'uses'=>'ProfessorsController@relatorio', 'is'=>'professor']);
});

//Pedagógio
Route::group(['as'=>'pedagogico.','prefix'=>'pedagogico', 'middleware' => ['auth', 'acl']], function(){
  Route::get('',['as'=>'index','uses'=>'RequisitosController@index', 'can'=>'view.requisito']);
  Route::post('store', ['as'=>'requisitos.store', 'uses' => 'RequisitosController@store', 'can'=>'create.requisito']);
});
