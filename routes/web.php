<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;

// Rutas públicas
Route::get('/', [tu ::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Rutas de administración
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('projects', AdminProjectController::class);
});

// Ruta de autenticación (puedes usar Laravel Breeze o Jetstream)
// require __DIR__.'/auth.php';
