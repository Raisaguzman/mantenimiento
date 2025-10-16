@extends ('layouts.app')

@section('titulo', 'Equipos')

@section('contenido')

<div class="bg-gray-100 min-h-screen p-6">
    <div class="flex justify-end mb-4">
        <a href="{{ route('equipos.create') }}" class="btn btn-outline">Nuevo equipo</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

        @foreach($equipos as $equipo)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="flex flex-col h-full">
                <div class="w-full h-36 bg-gray-100 flex items-center justify-center">
                    @if($equipo->imagen)
                    <img src="{{ asset('storage/equipo/' . $equipo->imagen) }}" alt="{{ $equipo->nombre }}" class="h-full object-cover" />
                    @else
                    <img src="https://via.placeholder.com/240x240?text=Sin+Imagen" alt="Sin imagen" class="h-full object-cover" />
                    @endif
                </div>

                <div class="p-4 flex flex-col justify-between flex-grow">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $equipo->nombre }}</h2>
                    <div class="text-sm text-gray-600 space-y-1 mb-4">
                        <p><span class="font-medium text-blue-700">Marca:</span> {{ $equipo->marca }}</p>
                        <p><span class="font-medium text-blue-700">Modelo:</span> {{ $equipo->modelo }}</p>
                        <p><span class="font-medium text-blue-700">Serie:</span> {{ $equipo->serie }}</p>
                        <p><span class="font-medium text-blue-700">Ubicación:</span> {{ $equipo->ubicacion }}</p>
                        <p><span class="font-medium text-blue-700">Tipo:</span> {{ $equipo->tipo }}</p>
                    </div>

                    <div class="flex justify-end space-x-2" x-data="{ open: false }">

                        <a href="{{ route('equipos.show', $equipo->id) }}"
                            class="bg-indigo-600 text-white px-4 py-1 rounded-lg hover:bg-indigo-700 transition">
                            Ver detalles
                        </a>
                        <!-- Botón Editar -->
                        <a href="{{ route('equipos.edit', $equipo->id) }}"
                            class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
                            Editar
                        </a>

                        <!-- Botón Eliminar con modal -->
                        <button @click="open = true"
                            class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                            Eliminar
                        </button>

                        <!-- Modal de confirmación -->
                        <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded shadow-lg w-80">
                                <h2 class="text-lg font-semibold mb-4">¿Estás segura de que deseas eliminar este equipo?</h2>
                                <div class="flex justify-end space-x-2">
                                    <button @click="open = false"
                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                        Cancelar
                                    </button>
                                    <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection