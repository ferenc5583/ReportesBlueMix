<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductosEnTransito;

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


//---------------------------Mercaderia en trancito----------------------------------\\
Route::post('/getProductos','ProductosEnTransito\ProductosEnTransitoController@Buscar');
Route::post('/GenerarProductosEnTrancito','ProductosEnTransito\ProductosEnTransitoController@GenerarProductoEnTrancito');

Route::get('/GetCaja/{id}','ProductosEnTransito\ProductosEnTransitoController@GetCaja');
Route::put('/UpdateCaja/{id}','ProductosEnTransito\ProductosEnTransitoController@UpdateCaja');

Route::get('/ReIngresarMercaderia/{id}','ProductosEnTransito\ProductosEnTransitoController@ReIngresarMercaderia');

Route::get('/GetProductoTransito','ProductosEnTransito\ProductosEnTransitoController@GetProductoTransito');
Route::get('/GetListadoCajas','ProductosEnTransito\ProductosEnTransitoController@GetListadoCajas');


//-------------------------------Session en React ----------------------------------------\\
Route::get('/getSession','ApiController@GetSession');


//---------------------------------Colegios y coupones -------------------------------- */

Route::get('/GetColegios','colegios\ColegiosController@getColegios');
Route::post('/GenerarCupon','Cupones\CuponesController@GenerarCupon');



// Auth users
Route::post('/Login','Api\AuthController@Login');

Route::get('/Permisos/{id}','Api\AuthController@getPermission');

// validar los productos faltantes de una cotizacion jumpseller

Route::get('/ProductosFaltantes/{id}','Admin\Jumpseller\BluemixEmpresas\GenerarCarritoController@VerProductosFaltantes');







/*
Route::get('ProductosNegativos',function(){
//   return datatables(DB::table('productos_negativos'))->toJson();
//
});*/
