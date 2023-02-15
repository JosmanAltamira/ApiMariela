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

// Route::get('/eliminar',function () {
//     $producto = Producto::findOrFail(3);
//     $producto->delete();
// });

//buscar producto por nombre 
Route::get('/buscar', function () {
    $producto = Producto::where('nombre','reloj')->get();
    echo $producto;
});

//eliminado logico
Route::get('/eliminarLogico', function () {
    $producto = Producto::find(2);
    $producto->delete();
});


///>>>>Alumnos
Route::get('/consulta', function () {
    foreach(Alumno::all() as $alumno){
        echo $alumno->nombre;
    }
});

Route::get('/buscarPorId', function () {
    $alumno = Alumno::all();
    echo $alumno->find(2);
});

Route::get('/buscarPorId2', function () {
    $alumno = Alumno::find(2);
    echo $alumno->nombre;
});

Route::get('/buscarPorId3', function () {
    $alumno = Alumno::findOrFail(3);
    echo $alumno->nombre;
});

Route::get('/insertar',function () {
    $alumno = new Alumno;
    $alumno->nombre = 'paco';
    $alumno->apellido_paterno = 'garcia';
    $alumno->apellido_materno = 'basques';
    $alumno->direccion = 'av 33';
    $alumno->ciudad = 'cordoba';
    $alumno->entidad_federativa = 'veracruz';
    $alumno->codigo_postal = '94575';
    $alumno->estado = 1;
    $alumno->save();
});



//API
Route::get('/productosApi/index','App\Http\controllers\ProductoApiController@index'); 
Route::post('/productosApi/store','App\Http\controllers\ProductoApiController@store');
Route::get('/productosApi/buscar/{nombre}','App\Http\controllers\ProductoApiController@buscar');

Route::get('/alumnosApi/index','App\Http\controllers\AlumnoApiController@index');
Route::post('/alumnosApi/store','App\Http\controllers\AlumnoApiController@store');


use App\Http\controllers\ProductoApiController;
Route::resource('productos',ProductoApiController::class);

use App\Http\controllers\AlumnoApiController;
Route::resource('alumnos',AlumnoApiController::class);

