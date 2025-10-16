<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteMantenimiento extends Model
{
    use HasFactory;
    protected $table = 'reporte_mantenimiento';
    protected $fillable = [
        'equipo_id',
        'tipo_mantenimiento', // preventivo o correctivo
        'descripcion',
        'fecha_realizacion',
        'tecnico_responsable',
        'observaciones',
    ];

    // Relación con el equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
