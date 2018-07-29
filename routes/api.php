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

Route::group(['prefix' => 'heroi'], function() {
	Route::get('/', 				'HeroiController@index');
	Route::post('/', 				'HeroiController@store');
	Route::get('/{id}', 			'HeroiController@show');
	Route::patch('/{id}', 			'HeroiController@update');
	Route::delete('/{id}', 			'HeroiController@destroy');
});

Route::group(['prefix' => 'classe'], function() {
	Route::get('/', 				'ClasseController@index');
	Route::post('/', 				'ClasseController@store');
	Route::get('/{id}', 			'ClasseController@show');
	Route::patch('/{id}', 			'ClasseController@update');
	Route::delete('/{id}', 			'ClasseController@destroy');
});

Route::group(['prefix' => 'especialidade'], function() {
	Route::get('/', 				'EspecialidadeController@index');
	Route::post('/', 				'EspecialidadeController@store');
	Route::get('/{id}', 			'EspecialidadeController@show');
	Route::patch('/{id}', 			'EspecialidadeController@update');
	Route::delete('/{id}', 			'EspecialidadeController@destroy');
});

// Cliente
Route::group(['prefix' => 'cliente'], function() {
	Route::get('/', 				'ClienteController@index');
	Route::post('/', 				'ClienteController@store');
	Route::get('/{id}', 			'ClienteController@show');
	Route::patch('/{id}', 			'ClienteController@update');
	Route::delete('/{id}', 			'ClienteController@destroy');
});