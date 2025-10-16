<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\CronogramaMantenimientoController;
use App\Http\Controllers\ReporteMantenimientoController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome')->name('home');
Route::resource('equipos', EquipoController::class)->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cronogramas', CronogramaMantenimientoController::class);
    Route::get('/equipos/{id}', [EquipoController::class, 'show'])->name('equipos.show');
    Route::resource('reportes', ReporteMantenimientoController::class);
    Route::get('/reportes/{id}', [ReporteMantenimientoController::class, 'show'])->name('reportes.show');


});

require __DIR__ . '/auth.php';
