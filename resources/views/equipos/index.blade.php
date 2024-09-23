@extends ('layouts.app')

@section('titulo', 'Equipos')

@section('contenido')

<div class="flex justify-end m-4">
        <a href="{{ route('equipos.create') }}" class="btn btn-outline">Nuevo equipo</a>
    </div>

<div class= "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 m-6">

    @foreach($equipos as $equipo)

    <div class="card card-side bg-base-100 shadow-xl">
        <figure>
            <img
                src="https://picsum.photos/id/{{$equipo->id}}/240"
                alt="{{ $equipo -> nombre }}" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ $equipo -> nombre }}</h2>
            <p>{{ $equipo -> marca }}, {{ $equipo -> modelo }}, {{ $equipo -> serie }}</p>
            <div class="card-actions justify-end">
                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-outline btn-xs">Editar</a>
                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-xs">Eliminar</button>
                    </form>
            </div>
        </div>
    </div>

    @endforeach
</div>

@endsection