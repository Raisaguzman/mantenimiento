@extends ('layouts.app')

@section('titulo', 'Página principal')

@section('contenido')
<h1 class="text-3xl font-bold underline text-blue-500">LISTA DE PRODUCTOS</h1>
<ul>
  @foreach ($equipos as $equipo)
   <li>{{$equipo->nombre}} - Serie: {{$equipo->serie}} </li>
  @endforeach
</ul>
@endsection