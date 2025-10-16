<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CronogramaMantenimiento;
use App\Models\ReporteMantenimiento;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'marca', 'modelo', 'serie', 'ubicacion', 'tipo', 'imagen'];

    public function cronogramas()
    {
        return $this->hasMany(CronogramaMantenimiento::class);
    }

    public function reportesMantenimiento()
    {
        return $this->hasMany(ReporteMantenimiento::class, 'equipo_id');
    }
}
