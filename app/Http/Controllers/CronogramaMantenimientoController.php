<?php

namespace App\Http\Controllers;


use App\Models\CronogramaMantenimiento;
use App\Models\Equipo; // Importa la clase Equipo
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CronogramaMantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cronogramas = CronogramaMantenimiento::with('equipo')->latest()->get();
        $equipos = Equipo::all();

        return view('cronogramas.index', compact('cronogramas', 'equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('cronogramas.create', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'tipo' => 'required|string',
            'frecuencia' => 'required|string',
            'proxima_fecha' => 'required|date',
            'responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        CronogramaMantenimiento::create($validated);

        return redirect()->back()->with('success', 'Cronograma creado correctamente.');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CronogramaMantenimiento $cronograma)
    {
        return view('cronogramas.show', compact('cronograma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cronogramas = CronogramaMantenimiento::findOrFail($id);
        $equipos = Equipo::all();

        return view('cronogramas.edit', compact('cronogramas', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'tipo' => 'required|string',
            'frecuencia' => 'required|string',
            'proxima_fecha' => 'required|date',
            'responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $cronograma = CronogramaMantenimiento::findOrFail($id);
        $cronograma->update($request->all());

        return redirect()->route('cronogramas.index')
            ->with('success', 'Cronograma actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cronograma = CronogramaMantenimiento::findOrFail($id);
        $cronograma->delete();

        return redirect()->route('cronogramas.index')
            ->with('success', 'Cronograma eliminado correctamente.');
    }
}
