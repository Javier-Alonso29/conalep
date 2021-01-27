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

		Route::resource('/administradores','SuperUsuario\AdministradoresController');

		Route::resource('/planteles','SuperUsuario\PlantelesController');

		Route::resource('/permisos','SuperUsuario\PermisosController');

		//Route::get('/permisos/eliminar/{id_plantel}/{id_proceso}/{id_user}',[ 'as' => 'eliminar', 'uses' => 'SuperUsuario\PermisosController@eliminar'])->name('permisos.eliminar');
		Route::get('/permisos/eliminar','SuperUsuario\PermisosController@eliminar')->name('permisos.eliminar');


	});
	
});


/**
* Rutas del administrador
*/
Route::group(['middleware' => ['Administrador','auth',]], function(){

	Route::get('/administrador', 'Administrador\HomeController@index')->name('administrador');

	Route::prefix('administrador')->middleware(['Administrador','auth',])->group(function (){

		Route::resource('/procesos','Administrador\ProcesosController');
		Route::resource('/tipodocumento','Administrador\TipodocumentoController');
		Route::post('/procesos/downloadFolder','Administrador\ZipController@downloadFolder')->name('procesos.download.folder');
		Route::resource('/subprocesos','Administrador\SubprocesosController');
		Route::post('/subprocesos/downloadFolder','Administrador\ZipController@downloadFolder')->name('subprocesos.download.folder');

	});
	
});
