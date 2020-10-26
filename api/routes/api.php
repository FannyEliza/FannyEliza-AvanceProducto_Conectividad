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
//TOKEN
Route::get('token','BienvenidoController@getToken');
// CRUD DE EMPRESA
Route::get('empresas', 'empresaController@inicio')->middleware('token');
Route::get('empresaMostrar', 'empresaController@mostrarEmpresa')->middleware('token');
Route::get('tablaEmpresa', 'empresaController@tablaEmpresa')->middleware('token');
Route::get('empresas/{id}', 'empresaController@mostrar')->middleware('token');
Route::post('empresas', 'empresaController@registrar')->middleware('token');
Route::post('empresas/{id}', 'empresaController@actualizar')->middleware('token');
Route::delete('empresa/{id}', 'empresaController@eliminar')->middleware('token');
Route::patch('empresa/{id}', 'empresaController@cambiarEstado')->middleware('token');
// *********************************************************

// CRUD DE PRODUCTO 
/* Route::get('productos', 'productoController@inicio')->middleware('token');
Route::get('productoMostrar', 'productoController@mostrarProducto')->middleware('token');
Route::get('tablaProducto', 'productoController@tablaProducto')->middleware('token');
Route::get('productos/{id}', 'productoController@mostrar')->middleware('token');
Route::delete('producto/{id}', 'productoController@eliminar')->middleware('token');
Route::get('tablaProducto', 'productoController@tablaProducto')->middleware('token'); */

Route::get('productos', 'productoController@listar')->middleware('token');
Route::get('producto/{id}', 'productoController@leer')->middleware('token');
Route::post('productos', 'productoController@registrar')->middleware('token');
Route::put('producto/{id}', 'productoController@actualizar')->middleware('token');
//Route::get('productos', 'productoController@editar')->middleware('token');
/*Route::get('productos/{id}', 'productoController@mostrar')->middleware('token');*/
Route::patch('producto/{id}', 'productoController@cambiarVigencia')->middleware('token');

// *********************************************************

// CRUD DE CATEGORIA 
Route::get('categoriaMostrar', 'productoController@mostrarCategoria')->middleware('token');
// *********************************************************

// CRUD DE MARCA 
Route::get('marcaMostrar', 'productoController@mostrarMarca')->middleware('token');
// *********************************************************