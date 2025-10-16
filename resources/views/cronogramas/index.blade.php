@extends('layouts.app')

@section('titulo', 'Cronograma de mantenimiento')

@section('contenido')
<div class="max-w-6xl mx-auto p-6">

    {{-- ✅ Título --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
        Cronograma de Mantenimiento
    </h1>

    {{-- ✅ Formulario de registro --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-10">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Registrar nuevo mantenimiento</h2>

        <form action="{{ route('cronogramas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium">Equipo:</label>
                <select name="equipo_id" class="w-full border-gray-300 rounded-lg" required>
                    <option value="">Seleccione un equipo</option>
                    @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Tipo de mantenimiento:</label>
                <select name="tipo" class="w-full border-gray-300 rounded-lg" required>
                    <option value="preventivo">Preventivo</option>
                    <option value="correctivo">Correctivo</option>
                    <option value="predictivo">Predictivo</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Frecuencia:</label>
                <select name="frecuencia" class="w-full border-gray-300 rounded-lg" required>
                    <option value="mensual">Mensual</option>
                    <option value="trimestral">Trimestral</option>
                    <option value="semestral">Semestral</option>
                    <option value="anual">Anual</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Próxima fecha:</label>
                <input type="date" name="proxima_fecha" class="w-full border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Responsable:</label>
                <input type="text" name="responsable" class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="md:col-span-3">
                <label class="block text-gray-700 font-medium">Observaciones:</label>
                <textarea name="observaciones" class="w-full border-gray-300 rounded-lg" rows="2"></textarea>
            </div>

            <div class="md:col-span-3 text-right mt-3">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Guardar cronograma
                </button>
            </div>
        </form>
    </div>

    {{-- ✅ Listado de cronogramas --}}
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Cronogramas programados</h2>

        @if($cronogramas->isEmpty())
        <p class="text-gray-600 text-center">No hay cronogramas registrados.</p>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Equipo</th>
                        <th class="px-4 py-2 border">Tipo</th>
                        <th class="px-4 py-2 border">Frecuencia</th>
                        <th class="px-4 py-2 border">Próxima fecha</th>
                        <th class="px-4 py-2 border">Responsable</th>
                        <th class="px-4 py-2 border">Observaciones</th>
                        <th class="px-4 py-2 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cronogramas as $cronograma)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $cronograma->equipo->nombre }}</td>
                        <td class="px-4 py-2 border capitalize">{{ $cronograma->tipo }}</td>
                        <td class="px-4 py-2 border capitalize">{{ $cronograma->frecuencia }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($cronograma->proxima_fecha)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">{{ $cronograma->responsable }}</td>
                        <td class="px-4 py-2 border">{{ $cronograma->observaciones }}</td>
                        <td class="px-4 py-2 border text-center">
                            <div class="flex justify-center gap-2" x-data="{ open: false }">
                                {{-- Botón Editar --}}
                                <a href="{{ route('cronogramas.edit', $cronograma->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs">
                                    Editar
                                </a>

                                {{-- Botón Eliminar con modal --}}
                                <button @click="open = true"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs">
                                    Eliminar
                                </button>

                                {{-- Modal de confirmación --}}
                                <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                            ¿Deseas eliminar el cronograma de <span class="text-red-600 font-bold">{{ $cronograma->equipo->nombre }}</span>?
                                        </h2>
                                        <div class="flex justify-end gap-3">
                                            <button @click="open = false"
                                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                                Cancelar
                                            </button>
                                            <form action="{{ route('cronogramas.destroy', $cronograma->id) }}" method="POST">
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

</div>
@endsection