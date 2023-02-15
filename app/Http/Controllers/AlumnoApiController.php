<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consultar alumnos activos
        $alumnos = Alumno::where('estado',1)->get()->toJson(JSON_PRETTY_PRINT);
        return response($alumnos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alumno = new Alumno();
        $alumno->nombre = $request->nombre;
        $alumno->apellido_paterno = $request->apellido_paterno;
        $alumno->apellido_materno = $request->apellido_materno;
        $alumno->direccion = $request->direccion;
        $alumno->ciudad = $request->ciudad;
        $alumno->entidad_federativa = $request->entidad_federativa;
        $alumno->estado = $request->estado;
        $alumno->codigo_postal = $request->codigo_postal;

        $alumno->save();

        return response()->json([
            "message" => "Alumno creado"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //consultar alumno por ciudad, entidad federativa o codigo postal
        if (Alumno::where('id', $id)->exists()) {
            $alumno = Alumno::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($alumno, 200);
        } else if (Alumno::where('ciudad', $id)->exists()) {
            $alumno = Alumno::where('ciudad', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($alumno, 200);
        } else if (Alumno::where('entidad_federativa', $id)->exists()) {
            $alumno = Alumno::where('entidad_federativa', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($alumno, 200);
        }else if (Alumno::where('codigo_postal', $id)->exists()) {
            $alumno = Alumno::where('codigo_postal', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($alumno, 200);
        } else {
            return response()->json([
                "message" => "Alumno no encontrado"
            ], 404);
        } 
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
        if (Alumno::where('id', $id)->exists()) {
            $alumno = Alumno::find($id);

            $alumno->nombre = is_null($request->nombre) ? $alumno->nombre : $request->nombre;
            $alumno->apellido_paterno = is_null($request->apellido_paterno) ? $alumno->apellido_paterno : $request->apellido_paterno;
            $alumno->apellido_materno = is_null($request->apellido_materno) ? $alumno->apellido_materno : $request->apellido_materno;
            $alumno->direccion = is_null($request->direccion) ? $alumno->direccion : $request->direccion;
            $alumno->ciudad = is_null($request->ciudad) ? $alumno->ciudad : $request->ciudad;
            $alumno->entidad_federativa = is_null($request->entidad_federativa) ? $alumno->entidad_federativa : $request->entidad_federativa;
            $alumno->estado = is_null($request->estado) ? $alumno->estado : $request->estado;
            $alumno->codigo_postal = is_null($request->codigo_postal) ? $alumno->codigo_postal : $request->codigo_postal;
            $alumno->save();

            return response()->json([
                "message" => "Alumno actualizado"
            ], 200);
        } else {
            return response()->json([
                "message" => "Alumno no encontrado"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //eliminado logico
        if (Alumno::where('id', $id)->exists()) {
            $alumno = Alumno::find($id);
            $alumno->estado = 0;
            $alumno->save();

            return response()->json([
                "message" => "Alumno eliminado"
            ], 202);
        } else {
            return response()->json([
                "message" => "Alumno no encontrado"
            ], 404);
        }
    }
}
