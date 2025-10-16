@extends('layouts.app')

@section('titulo', 'Nuevo cronograma')
@section('contenido')

<h2>Registrar cronograma de mantenimiento</h2>

<form action="{{ route('cronogramas.store') }}" method="POST">
    @csrf

    <label>Equipo:</label>
    <select name="equipo_id" required>
        <option value="">Seleccione un equipo</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
        @endforeach
    </select>

    <label>Tipo de mantenimiento:</label>
    <select name="tipo" required>
        <option value="preventivo">Preventivo</option>
        <option value="correctivo">Correctivo</option>
        <option value="predictivo">Predictivo</option>
    </select>

    <label>Frecuencia:</label>
    <select name="frecuencia" required>
        <option value="mensual">Mensual</option>
        <option value="trimestral">Trimestral</option>
        <option value="semestral">Semestral</option>
        <option value="anual">Anual</option>
    </select>

    <label>Próxima fecha:</label>
    <input type="date" name="proxima_fecha" required>

    <label>Responsable:</label>
    <input type="text" name="responsable">

    <label>Observaciones:</label>
    <textarea name="observaciones"></textarea>

    <button type="submit">Guardar cronograma</button>
</form>
@endsection
