<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronogramaMantenimiento extends Model
{
    use HasFactory;
    protected $fillable = ['equipo_id', 'tipo', 'frecuencia','proxima_fecha','responsable','observaciones'];
    
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
