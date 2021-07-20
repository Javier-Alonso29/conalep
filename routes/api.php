<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/procesos/{id}/procesospersonales', 'Administrador\ProcesosPersonalesController@api_sub_procesos');
Route::get('/planteles/municipio','SuperUsuario\PlantelesController@api_municipios');
Route::get('/permisos/planteles','SuperUsuario\PermisosController@api_planteles');
Route::get('/permisos/procesos','SuperUsuario\PermisosController@api_procesos');
Route::get('/permisos/usuarios','SuperUsuario\PermisosController@api_usuarios');
Route::get('/permisos/leer','SuperUsuario\PermisosController@api_planteles');
Route::get('/permisos/descargar','SuperUsuario\PermisosController@api_procesos');
Route::get('/permisos/subir','SuperUsuario\PermisosController@api_usuarios');
Route::get('/permisos/borrar','SuperUsuario\PermisosController@api_usuarios');

Route::get('/documento/tipo_documento','Administrador\DocumentoController@api_tipos_documentos');
Route::get('/documento/api_procesos_personal','Administrador\DocumentoController@api_procesos_personal');