<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify'=>true]);
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['middleware' => ['guest']], function () {
	Route::get('/', function () {
		return view('auth.login');
    });
});

Route::get('/home','UsuariosController@validaUsuarios');

/**
* Rutas del Super usuario
*/


/**
* Rutas del administrador
*/

Route::group(['middleware' => ['Administrador','auth',]], function(){

	Route::get('/administrador', 'Administrador\HomeController@index')->name('administrador');
	
});
