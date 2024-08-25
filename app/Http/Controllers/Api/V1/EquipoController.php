<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Equipo::all());
        200; //muestra todos los equipos
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar datos
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'marca' => ['required', 'string', 'max:100'],
            'modelo' => ['required', 'string', 'max:100'],
            'serie' => ['required', 'string', 'max:100'],
        ]);

        //guardar datos

        $equipo = Equipo::created($datos);

        //respuesta usuario

        return response()->json([
            'success' => true,
            'message' => 'equipo creado exitosamente'
        ],);
        201;
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        return response()->json($equipo, 200); //mostrar producto
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        //validar datos
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'marca' => ['required', 'string', 'max:100'],
            'modelo' => ['required', 'string', 'max:100'],
            'serie' => ['required', 'string', 'max:100'],
        ]);

        //guardar datos

        $equipo->update($datos);

        //respuesta usuario

        return response()->json([
            'success' => true,
            'message' => 'equipo actualizado exitosamente'
        ],);
        200;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //eliminar producto

        $equipo->delete();

        //respuesta al cliente
        return response()->json([
            'succes' => true,
            'message' => 'Equipo eliminado exitosamente',
            204
        ]);
    }
}
