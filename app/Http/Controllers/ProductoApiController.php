<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $productos = Producto::get()->toJson(JSON_PRETTY_PRINT);
    //     return response($productos, 200);
    // }

        //consultar productos activos 
        public function index(){
            $productos = Producto::where('estado',1)->get()->toJson(JSON_PRETTY_PRINT);
            return response($productos, 200);
        }

    /**
     * Muestre el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Almacene un recurso recién creado en almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->estado = $request->input('estado');
        $producto->save();
        return response()->json([
            "message" => "Producto creado"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //buscar por id
    public function show($id)
    {
        if (Producto::where('id', $id)->exists()) {
            $producto = Producto::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($producto, 200);
        } else if (Producto::where('nombre', $id)->exists()) {
            $producto = Producto::where('nombre', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($producto, 200);
        } else {
            return response()->json([
                "message" => "Producto no encontrado"
            ], 404);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Producto::where('id',$id)->exists()){
            $producto = Producto::find($id);
            $producto->nombre = is_null($request->nombre) ? $producto->nombre : $request->nombre;
            $producto->precio = is_null($request->precio) ? $producto->precio : $request->precio;
            $producto->estado = is_null($request->estado) ? $producto->estado : $request->estado;
            $producto->save();
            return response()->json(
                [
                    "mensaje" => "Producto actualizado con exito."
                ],
                200
            );
        }else{
            return response()-json([
                "mensaje"=>'Producto no encontrado.'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     if(Producto::where('id',$id)->exists()){
    //         $producto = Producto::find($id);
    //         $producto->delete();
    //         return response()->json(
    //             [
    //                 "mensaje" => "Producto eliminado con exito."
    //             ],
    //             200
    //         );
    //     }else{
    //         return response()->json([
    //             "mensaje" => 'Producto no encontrado'
    //         ],404);
    //     }
    // }
 
    //eliminado logico 
    public function destroy($id){
        if(Producto::where('id',$id)->exists()){
            $producto = Producto::find($id);
            $producto->estado = 0;
            $producto->save();
            return response()->json(
                [
                    "mensaje" => "Producto eliminado logicamente."
                ],
                200
            );
        }else{
            return response()->json([
                "mensaje" => 'Producto no encontrado'
            ],404);
        }
    }


}
