@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-6">
  <h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Dashboard de Mantenimiento</h1>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-blue-100 p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold text-gray-700">Equipos registrados</h2>
      <p class="text-3xl font-bold text-blue-700">{{ $totalEquipos }}</p>
    </div>
    <div class="bg-green-100 p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold text-gray-700">Mantenimientos realizados</h2>
      <p class="text-3xl font-bold text-green-700">{{ $totalMantenimientos }}</p>
    </div>
    <div class="bg-yellow-100 p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold text-gray-700">Este mes</h2>
      <p class="text-3xl font-bold text-yellow-700">{{ $mantenimientosMes }}</p>
    </div>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow mb-8">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Evolución de mantenimientos por mes</h2>
    <canvas id="mantenimientosChart" style="max-width: 700px; height: 100px";></canvas>
  </div>

  <div class="bg-white p-6 rounded-2xl shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Próximos mantenimientos (7 días)</h2>
    @if($proximosMantenimientos->isEmpty())
    <p class="text-gray-500">No hay mantenimientos programados para los próximos 7 días.</p>
    @else
    <table class="min-w-full border border-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left">Equipo</th>
          <th class="px-4 py-2 text-left">Tipo</th>
          <th class="px-4 py-2 text-left">Próxima Fecha</th>
          <th class="px-4 py-2 text-left">Responsable</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($proximosMantenimientos as $m)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $m->equipo_id }}</td>
          <td class="px-4 py-2">{{ $m->tipo }}</td>
          <td class="px-4 py-2">{{ \Carbon\Carbon::parse($m->proxima_fecha)->format('d/m/Y') }}</td>
          <td class="px-4 py-2">{{ $m->responsable }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('mantenimientosChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($labels),
      datasets: [{
        label: 'Mantenimientos realizados',
        data: @json($data),
        borderColor: '#2563eb',
        backgroundColor: 'rgba(37,99,235,0.2)',
        borderWidth: 2,
        tension: 0.3,
        fill: true
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection