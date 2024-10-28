<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\DireccionUsuarioController;

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/', function () {
    return view('oneview');
});

Route::get('/pago', [DireccionUsuarioController::class, 'mostrarDireccion'])->name('pago');

Route::get('/pago', [CarritoController::class, 'pago'])->name('pago');

Route::post('/pago', [CarritoController::class, 'checkout'])->name('pago.confirmar');

Route::post('/guardar-direccion', [DireccionUsuarioController::class, 'guardarDireccion'])->name('direccion.guardar');

Route::get('/sucursales', [SucursalController::class, 'showSucursales']);

Route::get('/', [CategoriaController::class, 'index'])->name('home');

Route::get('/categorias/{slug}', [CategoriaController::class, 'productosPorCategoria'])->name('categoria.productos');
Route::get('/productos/{slug}', [ProductoController::class, 'show'])->name('productos.show');

Route::post('/contact', [ContactController::class, 'send'])
    ->middleware('auth') 
    ->name('contact.send');

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
