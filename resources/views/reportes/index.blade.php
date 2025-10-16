@extends('layouts.app')

@section('titulo', 'Reportes de Mantenimiento')

@section('contenido')
<div class="max-w-6xl mx-auto p-6">
    {{-- ✅ Título --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Reportes de Mantenimiento</h1>

    {{-- ✅ Botón para crear nuevo reporte --}}
    <div class="mb-4 text-right">
        <a href="{{ route('reportes.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Nuevo reporte
        </a>
    </div>

    {{-- ✅ Tabla de reportes --}}
    @if($reportes->isEmpty())
    <p class="text-gray-600 text-center">No hay reportes registrados.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Equipo</th>
                    <th class="px-4 py-2 border">Tipo</th>
                    <th class="px-4 py-2 border">Descripción</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Técnico</th>
                    <th class="px-4 py-2 border">Observaciones</th>
                    <th class="px-4 py-2 border text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $reporte->equipo->nombre }}</td>
                    <td class="px-4 py-2 border capitalize">{{ $reporte->tipo_mantenimiento }}</td>
                    <td class="px-4 py-2 border">{{ $reporte->descripcion }}</td>
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($reporte->fecha_realizacion)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 border">{{ $reporte->tecnico_responsable ?? '—' }}</td>
                    <td class="px-4 py-2 border">{{ $reporte->observaciones ?? '—' }}</td>
                    <td class="px-4 py-2 border text-center">
                        <div class="flex justify-center gap-2" x-data="{ open: false }">
                            {{-- Botón Editar --}}
                            <a href="{{ route('reportes.edit', $reporte->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                Editar
                            </a>

                            {{-- Botón Eliminar con modal --}}
                            <button @click="open = true"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                Eliminar
                            </button>

                            {{-- Modal de confirmación --}}
                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-90"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                x-cloak>
                                <div class="bg-white p-6 rounded-lg shadow-lg w-80" @click.outside="open = false">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                        ¿Eliminar el reporte de <span class="text-red-600 font-bold">{{ $reporte->equipo->nombre }}</span>?
                                    </h2>
                                    <p class="text-sm text-gray-600 mb-4">Esta acción no se puede deshacer.</p>
                                    <div class="flex justify-end gap-3">
                                        <button @click="open = false"
                                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                            Cancelar
                                        </button>
                                        <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection