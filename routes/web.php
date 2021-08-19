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

		Route::get('/actividad/eliminar','SuperUsuario\ActividadController@eliminar')->name('actividad.eliminar');

		Route::get('/actividad/filtrar','SuperUsuario\ActividadController@filtrar')->name('actividad.filtrar');
		
		Route::get('/sesion/filtrar','SuperUsuario\SesionesController@filtrar')->name('sesiones.filtrar');
		
		Route::resource('/sesion', 'SuperUsuario\SesionesController');
		
		Route::resource('/administradores','SuperUsuario\AdministradoresController');
		Route::get('/administradores/cambiarpass/{id_usuario_cambio}','SuperUsuario\AdministradoresController@cambiarpass')->name('administradores.cambiarpass');
		
		Route::resource('/actividad','SuperUsuario\ActividadController');
		Route::get('/permisos/administrador/{id}', 'SuperUsuario\PermisosController@indexasignarprocesos')->name('usuario.asigna.permisos');
		Route::get('/permisos/administrador/asignar/{id}/{id_proceso}','SuperUsuario\PermisosController@asignarproceso')->name('usuario.asignar.proceso');
		Route::get('/permisos/administrador/quitar/{id_administrador}/{id_proceso}', 'SuperUsuario\PermisosController@quitarprocerso')->name('usuario.quitar.proceso');
		
		Route::get('/VistaArbol', 'SuperUsuario\ArbolController@arbol')->name('vistaArbol');
	});
	
});


/**
* Rutas del administrador
*/
Route::group(['middleware' => ['Administrador','auth',]], function(){

	Route::get('/administrador', 'Administrador\HomeController@index')->name('administrador');

	Route::prefix('administrador')->middleware(['Administrador','auth',])->group(function (){

		/**
		 * Procesos
		 */
		Route::resource('/procesos','Administrador\ProcesosController');
		Route::post('/procesos/downloadFolder','Administrador\ZipController@downloadFolder')->name('procesos.download.folder');

		/**
		 * Sub procesos
		 */
		Route::get('/subprocesos/{id}','Administrador\SubprocesosController@indexbyProceso')->name('subproceso.byproceso');
		Route::post('/subprocesos/create/','Administrador\SubprocesosController@storebyProceso')->name('subprocesos.create.byproceso');
		Route::post('/subprocesos/delete/{id}','Administrador\SubprocesosController@destroybyProceso')->name('subprocesos.destroy.byproceso');
		Route::post('/subprocesos/update/{id}','Administrador\SubprocesosController@updatebyProceso')->name('subprocesos.update.byproceso');
		Route::resource('/subprocesos','Administrador\SubprocesosController');
		Route::post('/subprocesos/downloadFolder','Administrador\ZipController@downloadFolder')->name('subprocesos.download.folder');

		/**
		 * Procesos personales
		 */
		Route::get('/misCarpetas/{id}', 'Administrador\ProcesosPersonalesController@indexbySubproceso')->name('misCarpetas.bySubproceso');
		Route::resource('/misCarpetas', 'Administrador\ProcesosPersonalesController');

		/**
		 * Tipos de documentos
		 */
		Route::resource('/tipodocumento','Administrador\TipodocumentoController');

		/**
		 * Documentos
		 */
		Route::get('/documentos/{id}','Administrador\DocumentoController@indexByProcesoPersonal')->name('documentos.byProcesoPersonal');
		Route::resource('/documentos','Administrador\DocumentoController');
		Route::post('/documentos/downloadFile','Administrador\DocumentoController@downloadFile')->name('documentos.downloadFile');

		/**
		 * Perfil
		 */
		Route::resource('/perfil','Administrador\PerfilController');
		Route::get('/perfil/cambiarpass/{id_usuario_cambio}','Administrador\PerfilController@cambiarpass')->name('perfil.cambiarpass');	


	});
	
});


/**
* Rutas del super usuario estatal
*/
Route::group(['middleware' => ['SUEstatal','auth',]], function(){

	Route::get('/SUEstatal', 'SUEstatal\HomeController@index')->name('SUEstatal');
	
	Route::prefix('SUEstatal')->middleware(['SUEstatal','auth',])->group(function (){

		
		Route::resource('/planteles','SuperUsuario\PlantelesController');

		Route::get('/permisos/administrador/{id}', 'SuperUsuario\PermisosController@indexasignarprocesos')->name('usuario.asigna.permisos');
		Route::get('/permisos/administrador/asignar/{id}/{id_proceso}','SuperUsuario\PermisosController@asignarproceso')->name('usuario.asignar.proceso');
		Route::get('/permisos/administrador/quitar/{id_administrador}/{id_proceso}', 'SuperUsuario\PermisosController@quitarprocerso')->name('usuario.quitar.proceso');
		

	});
	
});
