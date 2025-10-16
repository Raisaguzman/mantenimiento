<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Equipo::all());200; //muestra todos los equipos
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
            'ubicacion'=> ['required', 'string','max:100'],
            'tipo' => 'required|string|max:50',
            'imagen' => 'nullable|image|max:2048', // imagen opciona
        ]);

        if ($request->hasFile('imagen')) {
            try {
                $path = $request->file('imagen')->store('equipo', 'public');
                $datos['imagen'] = $path;
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al guardar la imagen: ' . $e->getMessage(),
                ], 500);
            }
        }

        //guardar datos        
        $equipo = Equipo::create($datos);

        //respuesta usuario
        return response()->json([
            'success' => true,
            'message' => 'Equipo creado exitosamente',
            'data' => $equipo,
        ], 201);
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
            'ubicacion' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'imagen' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($equipo->imagen && Storage::disk('public')->exists($equipo->imagen)) {
                Storage::disk('public')->delete($equipo->imagen);
            }
            $datos['imagen'] = $request->file('imagen')->store('equipos', 'public');
        }
        //guardar datos

        $equipo->update($datos);

        //respuesta usuario

        return response()->json([
            'success' => true,
            'message' => 'equipo actualizado exitosamente'
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //eliminar producto

        if ($equipo->imagen && Storage::disk('public')->exists($equipo->imagen)) {
            Storage::disk('public')->delete($equipo->imagen);
        }
    
        $equipo->delete();

        //respuesta al cliente
        return response()->json([
            'success' => true,
            'message' => 'Equipo eliminado exitosamente',

        ]);
    }
    
}
