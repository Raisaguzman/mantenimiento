<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteMantenimiento;
use App\Models\Equipo;
use App\Models\CronogramaMantenimiento; 


use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de equipos
        $totalEquipos = Equipo::count();

        // Total de mantenimientos realizados
        $totalMantenimientos = ReporteMantenimiento::count();

        // Mantenimientos realizados este mes
        $mantenimientosMes = ReporteMantenimiento::whereMonth('created_at', Carbon::now()->month)->count();

        // Próximos mantenimientos (7 días)
        $proximosMantenimientos = CronogramaMantenimiento::whereBetween('proxima_fecha', [Carbon::now(), Carbon::now()->addDays(7)])->get();

        // Gráfico: mantenimientos por mes
        $mantenimientosPorMes = ReporteMantenimiento::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $labels = [];
        $data = []; // Datos de ejemplo

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->format('M');
            $data[] = $mantenimientosPorMes[$i] ?? 0;
        }

        return view('dashboard', compact (
            'totalEquipos','totalMantenimientos','mantenimientosMes',
            'proximosMantenimientos',
            'labels',
            'data'),   );
    }
}
