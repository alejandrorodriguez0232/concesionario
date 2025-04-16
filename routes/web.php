<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//Route::resource('cars', CarController::class);

// Rutas públicas (accesibles sin autenticación)
/*Route::controller(CarController::class)->group(function () {
    Route::get('/cars', 'index')->name('cars.index');
    Route::get('/cars/{car}', 'show')->name('cars.show');
    Route::get('/cars/search', 'search')->name('cars.search');
});*/

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    Route::prefix('cars')->controller(CarController::class)->group(function () {
        // Creación
        Route::get('/create', 'create')->name('cars.create');
        Route::post('/', 'store')->name('cars.store');
        
        // Edición
        Route::get('/{car}/edit', 'edit')->name('cars.edit');
        Route::put('/{car}', 'update')->name('cars.update');
        
        // Eliminación
        Route::delete('/{car}', 'destroy')->name('cars.destroy');
        
        // Rutas adicionales
        Route::get('/{car}/history', 'history')->name('cars.history');
        Route::post('/{car}/upload', 'uploadImage')->name('cars.upload');
        Route::get('/cars', 'index')->name('cars.index');//verificar
    });
});

Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search');

require __DIR__.'/auth.php';
