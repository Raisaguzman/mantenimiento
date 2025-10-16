@extends('layouts.app')

@section('titulo', 'Nuevo Reporte')

@section('contenido')
<div class="max-w-4xl mx-auto p-6">
    {{-- ✅ Título --}}
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Registrar Reporte de Mantenimiento</h1>

    {{-- ✅ Formulario --}}
    <form action="{{ route('reportes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Equipo:</label>
            <select name="equipo_id" class="w-full border-gray-300 rounded-lg" required>
                <option value="">Seleccione un equipo</option>
                @foreach($equipos as $equipo)
                <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                    {{ $equipo->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Tipo de mantenimiento:</label>
            <select name="tipo_mantenimiento" class="w-full border-gray-300 rounded-lg" required>
                <option value="">Seleccione un tipo</option>
                <option value="preventivo" {{ old('tipo_mantenimiento') == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                <option value="correctivo" {{ old('tipo_mantenimiento') == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                <option value="predictivo" {{ old('tipo_mantenimiento') == 'predictivo' ? 'selected' : '' }}>Predictivo</option>
            </select>

        </div>

        <div>
            <label class="block text-gray-700 font-medium">Fecha de realización:</label>
            <input type="date" name="fecha_realizacion" class="w-full border-gray-300 rounded-lg"
                value="{{ old('fecha_realizacion') }}" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Técnico responsable:</label>
            <input type="text" name="tecnico_responsable" class="w-full border-gray-300 rounded-lg"
                value="{{ old('tecnico_responsable') }}">
        </div>

        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium">Descripción:</label>
            <textarea name="descripcion" class="w-full border-gray-300 rounded-lg" rows="3" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="block text-gray-700 font-medium">Observaciones:</label>
            <textarea name="observaciones" class="w-full border-gray-300 rounded-lg" rows="2">{{ old('observaciones') }}</textarea>
        </div>

        {{-- ✅ Botones --}}
        <div class="md:col-span-2 flex justify-end mt-4 space-x-3" x-data="{ open: false }">
            <!-- Botón Cancelar con modal -->
            <button type="button" @click="open = true"
                class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                Cancelar
            </button>

            <!-- Botón Guardar -->
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Guardar reporte
            </button>

            <!-- Modal de confirmación -->
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
                        ¿Deseas cancelar el registro? <br>
                        <span class="text-red-600 font-medium">Los datos ingresados se perderán.</span>
                    </h2>
                    <div class="flex justify-end gap-3">
                        <button @click="open = false"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                            Volver
                        </button>
                        <a href="{{ route('reportes.index') }}"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Cancelar registro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection