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

//Rotas de autenticação
Auth::routes();

//Agrupando por namespace dos controllers
$this->group(['namespace' =>'Admin'], function(){
    //Rota Login
	$this->get('/',     ['as'=>'auth.login','uses'=>'AdminController@login']);
	//Rota Home
	$this->get('admin', ['as'=>'admin.home.index','uses'=>'AdminController@index']);
	//Rota de Pesquisa dos históricos de movimentações
	$this->post('admin/transactions/index', ['as'=>'admin.transaction.search','uses'=>'TransactionController@search']);

});

//Rotas ações nos objetos

$this->resources([
	'admin/departments'    =>  'Admin\DepartmentController',
    'admin/employees'      =>  'Admin\EmployeeController',
    'admin/transactions'   =>  'Admin\TransactionController'
]);

//Rotas da API
$this->group(['prefix'=> 'api', 'namespace' => 'api'], function(){

 	$this->group(['prefix' => 'user'], function(){
 			
 			$this->get( '', ['uses' =>'UserController@allUsers'] );

 			$this->get( '{id}', ['uses' =>'UserController@getUser']);

 			$this->post( '', ['uses' =>'UserController@saveUser']);

 			$this->put( '{id}', ['uses' =>'UserController@updateUser']);

 			$this->delete( '{id}', ['uses' =>'UserController@deleteUsers']);

 	});

 });


