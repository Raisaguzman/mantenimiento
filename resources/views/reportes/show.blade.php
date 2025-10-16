@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">🧾 Detalle del Reporte de Mantenimiento</h2>

    @if($reporte)
        <div class="card shadow-sm p-4">
            <p><strong>Equipo:</strong> {{ $reporte->equipo->nombre ?? 'No asignado' }}</p>
            <p><strong>Tipo:</strong> {{ $reporte->tipo_mantenimiento ?? 'No especificado' }}</p>
            <p><strong>Fecha:</strong> {{ $reporte->fecha_realizacion ?? 'No registrada' }}</p>
            <p><strong>Técnico:</strong> {{ $reporte->tecnico_responsable ?? 'No asignado' }}</p>
            <p><strong>Descripción:</strong> {{ $reporte->descripcion ?? 'No hay descripción' }}</p>
            <p><strong>Observaciones:</strong> {{ $reporte->observaciones ?? 'No hay observaciones' }}</p>
        </div>
    @else
        <div class="alert alert-warning">No se encontró el reporte de mantenimiento.</div>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
</div>




@endsection

