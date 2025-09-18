<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas de administración
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Gestión de proyectos
    Route::resource('projects', AdminProjectController::class);
    Route::post('projects/{project}/toggle-featured', [AdminProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');
    Route::post('projects/{project}/toggle-active', [AdminProjectController::class, 'toggleActive'])->name('projects.toggle-active');
    
    // Gestión de habilidades
    Route::resource('skills', AdminSkillController::class);
    Route::post('skills/{skill}/toggle-active', [AdminSkillController::class, 'toggleActive'])->name('skills.toggle-active');
    
    // Gestión de experiencias
    Route::resource('experiences', AdminExperienceController::class);
    Route::post('experiences/{experience}/toggle-active', [AdminExperienceController::class, 'toggleActive'])->name('experiences.toggle-active');
    Route::post('experiences/{experience}/toggle-current', [AdminExperienceController::class, 'toggleCurrent'])->name('experiences.toggle-current');
    
    // Gestión de contactos
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/mark-read', [AdminContactController::class, 'markRead'])->name('contacts.mark-read');
    Route::post('contacts/{contact}/mark-replied', [AdminContactController::class, 'markReplied'])->name('contacts.mark-replied');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
});

// Rutas de autenticación básicas
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
