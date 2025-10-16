@extends('layouts.app')

@section('titulo', 'Editar cronograma')

@section('contenido')
<div class="max-w-6xl mx-auto p-6">

    {{-- ✅ Título --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
        Editar Cronograma de Mantenimiento
    </h1>

    {{-- ✅ Formulario de edición --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-10">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Actualizar cronograma</h2>

        <form action="{{ route('cronogramas.update', $cronogramas->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium">Equipo:</label>
                <select name="equipo_id" class="w-full border-gray-300 rounded-lg" required>
                    @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}" {{ $cronogramas->equipo_id == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Tipo de mantenimiento:</label>
                <select name="tipo" class="w-full border-gray-300 rounded-lg" required>
                    <option value="preventivo" {{ $cronogramas->tipo == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                    <option value="correctivo" {{ $cronogramas->tipo == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                    <option value="predictivo" {{ $cronogramas->tipo == 'predictivo' ? 'selected' : '' }}>Predictivo</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Frecuencia:</label>
                <select name="frecuencia" class="w-full border-gray-300 rounded-lg" required>
                    <option value="mensual" {{ $cronogramas->frecuencia == 'mensual' ? 'selected' : '' }}>Mensual</option>
                    <option value="trimestral" {{ $cronogramas->frecuencia == 'trimestral' ? 'selected' : '' }}>Trimestral</option>
                    <option value="semestral" {{ $cronogramas->frecuencia == 'semestral' ? 'selected' : '' }}>Semestral</option>
                    <option value="anual" {{ $cronogramas->frecuencia == 'anual' ? 'selected' : '' }}>Anual</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Próxima fecha:</label>
                <input type="date" name="proxima_fecha" class="w-full border-gray-300 rounded-lg" value="{{ $cronogramas->proxima_fecha }}" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Responsable:</label>
                <input type="text" name="responsable" class="w-full border-gray-300 rounded-lg" value="{{ $cronogramas->responsable }}">
            </div>

            <div class="md:col-span-3">
                <label class="block text-gray-700 font-medium">Observaciones:</label>
                <textarea name="observaciones" class="w-full border-gray-300 rounded-lg" rows="2">{{ $cronogramas->observaciones }}</textarea>
            </div>

            {{-- ✅ Botones de acción --}}
            <div class="md:col-span-3 flex justify-end mt-4 space-x-3" x-data="{ open: false }">
                <!-- Botón Cancelar con modal -->
                <button @click="open = true"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                    Cancelar
                </button>

                <!-- Botón Actualizar -->
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Actualizar cronograma
                </button>

                <!-- Modal de confirmación -->
                <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">
                            ¿Deseas cancelar la edición? <br><span class="text-red-600 font-medium">Los cambios no se guardarán.</span>
                        </h2>
                        <div class="flex justify-end gap-3">
                            <button @click="open = false"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                Volver
                            </button>
                            <a href="{{ route('cronogramas.index') }}"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Cancelar edición
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection