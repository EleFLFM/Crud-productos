<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de productos
    Route::resource('productos', ProductoController::class);
    Route::get('/productos-disponibles', [ProductoController::class, 'productosDisponibles'])->name('productos.disponibles');
    Route::post('/productos/{id}/vender', [ProductoController::class, 'vender'])->name('productos.vender');
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    
});

require __DIR__.'/auth.php';