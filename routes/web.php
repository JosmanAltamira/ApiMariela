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

use App\Models\Producto;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/consulta', function () {
    foreach(Producto::all() as $producto){
        echo $producto->nombre;
    }
});

Route::get('/buscarPorId', function () {
    $producto = Producto::all();
    echo $producto->find(2);
});

Route::get('/buscarPorId2', function () {
    $producto = Producto::find(2);
    echo $producto->nombre;
});

Route::get('/buscarPorId3', function () {
    $producto = Producto::findOrFail(3);
    echo $producto->nombre;
});

Route::get('/insertar',function () {
    $producto = new Producto;
    $producto->nombre = 'reloj';
    $producto->precio = 321;
    $producto->estado = 1;
    $producto->save();
});

Route::get('/actualizar',function () {
    $producto = Producto::findOrFail(3);
    $producto->precio = 400;
    $producto->save();
});

Route::get('/eliminar',function () {
    $producto = Producto::findOrFail(3);
    $producto->delete();
});

Route::get('/actualizar',function () {
    $producto = Producto::findOrFail(3);
    $producto->precio = 400;
    $producto->save();
});

//API
Route::get('/productosApi/index','App\Http\controllers\ProductoApiController@index'); 
Route::post('/productosApi/store','App\Http\controllers\ProductoApiController@store');


use App\Http\controllers\ProductoApiController;
Route::resource('productos',ProductoApiController::class);

