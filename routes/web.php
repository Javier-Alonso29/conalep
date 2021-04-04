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
Auth::routes(['register' => false]);
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
		Route::get('/permisos/administrador/{id}', 'SuperUsuario\PermisosController@indexasignarprocesos')->name('usuario.asigna.permisos');
		Route::get('/permisos/administrador/asignar/{id}/{id_proceso}','SuperUsuario\PermisosController@asignarproceso')->name('usuario.asignar.proceso');
		Route::get('/permisos/administrador/quitar/{id_administrador}/{id_proceso}', 'SuperUsuario\PermisosController@quitarprocerso')->name('usuario.quitar.proceso');
		

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

		/**
		 * Sub procesos
		 *  */
		Route::get('/subprocesos/{id}','Administrador\SubprocesosController@indexbyProceso')->name('subproceso.byproceso');
		Route::post('/subprocesos/create/','Administradores\SubprocesosController@storebyProceso')->name('subprocesos.create.byproceso');
		Route::resource('/subprocesos','Administrador\SubprocesosController');
		Route::post('/subprocesos/downloadFolder','Administrador\ZipController@downloadFolder')->name('subprocesos.download.folder');

	});
	
});
