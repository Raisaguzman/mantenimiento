@extends('layouts.app')

@section('titulo', 'Mis equipos | Editar equipo')
@section('cabecera', 'Editar equipo')

@section('contenido')
<div class="flex justify-center my-6">
    <div class="card bg-base-100 w-96 shadow-2xl">
        <form class="card-body" action="{{ route('equipos.update', $equipo->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Nombre --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nombre</span>
                </label>
                <input type="text" name="nombre" value="{{ $equipo->nombre }}" placeholder="Nombre del equipoo" class="input input-bordered" required />
            </div>
            {{-- Marca --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Marca</span>
                </label>
                <input type="text" name="marca" value="{{ $equipo->marca }}" placeholder="Marca" class="input input-bordered" />
            </div>
            {{-- Modelo --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Modelo</span>
                </label>
                <input type="text" name="modelo" value="{{ $equipo->modelo }}" placeholder="modelo" class="input input-bordered" required />
            </div>
            {{-- Serie --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Stock</span>
                </label>
                <input type="number" name="serie" value="{{ $equipo->serie }}" placeholder="Serie" class="input input-bordered" required />
            </div>
            {{-- Botones --}}
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">Actualizar Equipo</button>
                <a href="{{ route('equipos.index')}}" class="btn btn-outline mt-4">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection