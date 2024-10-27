<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;

Route::get('/', function () {
    return view('oneview');
});

Route::get('/', [CategoriaController::class, 'index'])->name('home');

Route::get('/categorias/{slug}', [CategoriaController::class, 'productosPorCategoria'])->name('categoria.productos');
Route::get('/productos/{slug}', [ProductoController::class, 'show'])->name('productos.show');

Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'show'])->name('carrito'); 
    Route::post('/carrito/add/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::post('/carrito/update/{producto}', [CarritoController::class, 'update'])->name('carrito.update');
    Route::delete('/carrito/remove/{producto}', [CarritoController::class, 'remove'])->name('carrito.remove');
    Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
