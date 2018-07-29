<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
	echo 'jeferson Oliveira';
    //return view('readme');
});

// Cliente
Route::group(['prefix' => 'cliente'], function() {
	Route::get('/', 				'ClienteController@index');
	Route::post('/', 				'ClienteController@store');
	Route::get('/{id}', 			'ClienteController@show');
	Route::patch('/{id}', 			'ClienteController@update');
	Route::delete('/{id}', 			'ClienteController@destroy');
});

// Fornecedor
Route::group(['prefix' => 'fornecedor'], function() {
	Route::get('/', 				'FornecedorController@index');
	Route::post('/', 				'FornecedorController@store');
	Route::get('/{id}', 			'FornecedorController@show');
	Route::patch('/{id}', 			'FornecedorController@update');
	Route::delete('/{id}', 			'FornecedorController@destroy');
});

// Produto
Route::group(['prefix' => 'produto'], function() {
	Route::get('/', 				'ProdutoController@index');
	Route::post('/', 				'ProdutoController@store');
	Route::get('/{id}', 			'ProdutoController@show');
	Route::patch('/{id}', 			'ProdutoController@update');
	Route::delete('/{id}', 			'ProdutoController@destroy');
});