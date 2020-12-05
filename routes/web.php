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

Route::get('/home','UsuariosController@validaUsuarios')->name('inicio');

/**
* Rutas del super usuario
*/
Route::group(['middleware' => ['SuperUsuario','auth',]], function(){

	Route::get('/superusuario', 'SuperUsuario\HomeController@index')->name('superusuario');

	Route::prefix('superusuario')->middleware(['SuperUsuario','auth',])->group(function (){

		Route::resource('/procesos','Administrador\ProcesosController');
		Route::resource('/administradores','SuperUsuario\AdministradoresController');

	});
	
});


/**
* Rutas del administrador
*/
Route::group(['middleware' => ['Administrador','auth',]], function(){

	Route::get('/administrador', 'Administrador\HomeController@index')->name('administrador');

	Route::prefix('administrador')->middleware(['Administrador','auth',])->group(function (){

		Route::resource('/procesos','Administrador\ProcesosController');

	});
	
});
