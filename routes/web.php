<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SpotifyController;

Route::get('/', function () {
    return view('oneview');
});

Route::get('/', [CategoriaController::class, 'index'])->name('home');

Route::get('/categorias/{slug}', [CategoriaController::class, 'productosPorCategoria'])->name('categoria.productos');

//

Route::post('/buscar-artista', [SpotifyController::class, 'buscarArtista'])->name('buscar.artista');
Route::post('/buscar-cancion', [SpotifyController::class, 'buscarCancion'])->name('buscar.cancion');

Route::get('/buscar-artista', function () {
    return view('spotify');
})->name('form.artista');


//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
