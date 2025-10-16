@extends('layouts.app')

@section('titulo', 'Detalles del equipo')

@section('contenido')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
        Equipo: {{ $equipo->nombre }}
    </h1>

    {{-- 🔹 Información técnica --}}
    <div class="container mt-4">
              <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
            {{-- Información técnica centrada en dos columnas --}}
            <div class="md:w-2/3 text-center">
                <h3 class="text-lg font-medium mb-4">Información Técnica</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 justify-center">
                    <p><strong>Marca:</strong> {{ $equipo->marca }}</p>
                    <p><strong>Modelo:</strong> {{ $equipo->modelo }}</p>
                    <p><strong>Serie:</strong> {{ $equipo->serie }}</p>
                    <p><strong>Tipo:</strong> {{ $equipo->tipo }}</p>
                    <p><strong>Ubicación:</strong> {{ $equipo->ubicacion }}</p>
                    <p><strong>Estado:</strong> {{ $equipo->estado ?? 'No especificado' }}</p>
                </div>
            </div>

            {{-- Imagen del equipo más pequeña y a la derecha --}}
            <div class="md:w-1/3 flex justify-center md:justify-end">
                <img src="{{ asset('storage/equipo/' . $equipo->imagen) }}"
                    alt="Imagen del equipo {{ $equipo->nombre }}"
                    class="w-32 rounded shadow-md">
            </div>
        </div>
    </div>

</div>
</div>

</div>
</div>


{{-- 🔹 Cronograma de mantenimiento --}}
<div class="bg-white shadow-md rounded-2xl p-6 mb-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700">Cronograma de mantenimiento</h2>

    @if($equipo->cronogramas->isEmpty())
    <p class="text-gray-500">No hay cronogramas registrados para este equipo.</p>
    @else
    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="py-2 px-3 text-left">Tipo</th>
                <th class="py-2 px-3 text-left">Frecuencia</th>
                <th class="py-2 px-3 text-left">Próxima fecha</th>
                <th class="py-2 px-3 text-left">Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipo->cronogramas as $cronograma)
            <tr class="border-t hover:bg-gray-50">
                <td class="py-2 px-3">{{ ucfirst($cronograma->tipo) }}</td>
                <td class="py-2 px-3">{{ ucfirst($cronograma->frecuencia) }}</td>
                <td class="py-2 px-3">{{ $cronograma->proxima_fecha }}</td>
                <td class="py-2 px-3">{{ $cronograma->responsable }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>

{{-- 🔹 Reportes de mantenimiento --}}
<div class="bg-white shadow-md rounded-2xl p-6">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700">Reportes de mantenimiento</h2>

    @if($equipo->reportesMantenimiento->isEmpty())
    <p class="text-gray-500">No hay reportes registrados para este equipo.</p>
    @else
    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="py-2 px-3 text-left">Fecha</th>
                <th class="py-2 px-3 text-left">Tipo</th>
                <th class="py-2 px-3 text-left">Técnico</th>
                <th class="py-2 px-3 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipo->reportesMantenimiento as $reporte)
            <tr class="border-t hover:bg-gray-50">
                <td class="py-2 px-3">{{ $reporte->fecha_realizacion }}</td>
                <td class="py-2 px-3">{{ ucfirst($reporte->tipo_mantenimiento) }}</td>
                <td class="py-2 px-3">{{ $reporte->tecnico_responsable ?? 'No asignado' }}</td>
                <td class="py-2 px-3">
                    <a href="{{ route('reportes.show', $reporte->id) }}"
                        class="text-blue-600 hover:underline">Ver detalle</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<div class="mt-6 text-center">
    <a href="{{ route('equipos.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
        Volver
    </a>
</div>
</div>


@endsection