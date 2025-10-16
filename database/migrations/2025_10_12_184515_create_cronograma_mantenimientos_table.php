<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('cronograma_mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['preventivo', 'correctivo', 'predictivo']);
            $table->enum('frecuencia', ['mensual', 'trimestral', 'semestral', 'anual']);
            $table->date('proxima_fecha');
            $table->string('responsable')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronograma_mantenimientos');
    }
};
