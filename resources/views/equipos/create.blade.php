@extends('layouts.app')

@section('titulo', 'Mis equipos | Crear equipo')
@section('cabecera', 'Crear equipo')

@section('contenido')
    <div class="flex justify-center my-6">
        <div class="card bg-base-100 w-96 shadow-2xl">
            <form class="card-body" action="{{ route('equipos.store') }}" method="POST">
                @csrf
                {{-- Nombre --}}
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Nombre</span>
                    </label>
                    <input type="text" name="nombre" placeholder="Nombre del equipo" class="input input-bordered" required />
                </div>
                {{-- Marca --}}
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Marca</span>
                    </label>
                    <input type="text" name="marca" placeholder="Marca" class="input input-bordered" />
                </div>
                {{-- Modelo --}}
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Modelo</span>
                    </label>
                    <input type="text" name="modelo" placeholder="Modelo" class="input input-bordered" required />
                </div>
                {{-- serie --}}
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Serie</span>
                    </label>
                    <input type="number" name="serie" placeholder="Serie" class="input input-bordered" required />
                </div>
                {{-- botones --}}
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Crear equipo</button>
                    <a href="{{ route('equipos.index')}}" class="btn btn-outline mt-4" >Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection