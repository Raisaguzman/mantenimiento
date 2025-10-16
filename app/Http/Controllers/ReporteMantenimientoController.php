<?php

namespace App\Http\Controllers;

use App\Models\ReporteMantenimiento;
use App\Models\Equipo;
use Illuminate\Http\Request;

class ReporteMantenimientoController extends Controller
{
    public function index()
    {
        $reportes = ReporteMantenimiento::with('equipo')->get();
        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        return view('reportes.create', compact('equipos'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'tipo_mantenimiento' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_realizacion' => 'required|date',
            'tecnico_responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        ReporteMantenimiento::create($validated);

        return redirect()->route('reportes.index')->with('success', 'Reporte creado correctamente.');
    }

    public function edit(ReporteMantenimiento $reporte)
    {
        $equipos = Equipo::all();
        return view('reportes.edit', compact('reporte', 'equipos'));
    }

    public function update(Request $request, ReporteMantenimiento $reporte)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'tipo_mantenimiento' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_realizacion' => 'required|date',
            'tecnico_responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        $reporte->update($request->all());

        return redirect()->route('reportes.index')->with('success', 'Reporte actualizado correctamente.');
    }


    public function show($id)
    {
        // Busca el reporte de mantenimiento por ID
        $reporte = ReporteMantenimiento::with('equipo')->findOrFail($id);

        // Retorna la vista del detalle
        return view('reportes.show', compact('reporte'));
    }

    public function destroy(ReporteMantenimiento $reporte)
    {
        $reporte->delete();
        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado.');
    }
}
