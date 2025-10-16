<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
 use HasFactory;
    protected $fillable = ['fecha', 'descripcion', 'estado', 'cronograma_mantenimiento_id'];
    public function cronograma()
{
    return $this->belongsTo(CronogramaMantenimiento::class);
}

}