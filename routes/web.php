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
Route::get('/turmas/show', 'TurmasController@show');
Route::get('chart', 'TurmasController@chart');
Route::get('components', 'TurmasController@components');

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
});

//Indisciplinas
Route::group(['as'=>'ocorrencias.', 'prefix'=>'ocorrencias','middleware'=>['auth','acl']], function(){
  Route::get('',['as'=>'index', 'uses'=>'OcorrenciasController@index', 'can'=>'create.disciplinar']);
  Route::post('indisciplinas/store', ['as'=>'indisciplinas.store', 'uses'=>'IndisciplinasController@store', 'is'=>'administrador']);
});

//Servidores
Route::group(['as'=>'empregados.', 'prefix'=>'empregados','middleware'=>['auth','acl']], function(){
  Route::get('', ['as'=>'index', 'uses'=>'EmpregadosController@index', 'can'=>'view.servidor']);
  Route::get('apiServidor', ['as'=>'apiServidor', 'uses'=>'EmpregadosController@apiServidor','can'=>'view.servidor']);
  Route::get('apiEquipe', ['as'=>'apiEquipe', 'uses'=>'EmpregadosController@apiEquipe','can'=>'view.servidor']);
  Route::get('{empregado}/show', ['as'=>'show', 'uses'=>'EmpregadosController@show', 'is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/status',['as'=>'status', 'uses'=>'EmpregadosController@status','is'=>'administrador|diretor|administrativo']);
  Route::get('create', ['as'=>'create','uses'=>'EmpregadosController@create','is'=>'administrador|diretor|administrativo']);
  Route::post('store',['as'=>'store', 'uses'=>'EmpregadosController@store', 'is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/edit',['as'=>'edit','uses'=>'EmpregadosController@edit', 'is'=>'administrador|diretor|administrativo']);
  Route::put('{empregado}/update',['as'=>'update', 'uses' => 'EmpregadosController@update', 'is'=>'administrador|diretor|administrativo']);
  Route::get('{empregado}/namo', ['as'=>'namo','uses'=>'EmpregadosController@namo','can'=>'view.servidor']);
  Route::post('{empregado}/ponto',['as'=>'ponto', 'uses'=>'EmpregadosController@ponto','is'=>'administrador|diretor|administrativo']);
});

//Equipe
Route::group(['as'=>'equipes.','prefix'=>'equipes','middleware'=>['auth','acl']], function(){
  Route::get('',['as'=>'index', 'uses'=>'EquipesController@index','is'=>'administrador|diretor|administrativo']);
  Route::get('{equipe}/edit', ['as'=>'edit', 'uses'=>'EquipesController@edit','is'=>'administrador|diretor|administrativo']);
  Route::put('{equipe}/update',['as'=>'update', 'uses' => 'EquipesController@update', 'is'=>'administrador|diretor|administrativo']);

});
