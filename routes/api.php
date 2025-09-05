<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API pública del portafolio
Route::prefix('v1')->group(function () {
    // Proyectos
    Route::get('/projects', function () {
        return Project::active()->orderBy('order')->paginate(12);
    });
    
    Route::get('/projects/featured', function () {
        return Project::active()->featured()->orderBy('order')->get();
    });
    
    Route::get('/projects/{project}', function (Project $project) {
        return $project;
    });
    
    // Habilidades
    Route::get('/skills', function () {
        return Skill::active()->ordered()->get()->groupBy('category');
    });
    
    // Experiencia
    Route::get('/experience', function () {
        return Experience::active()->ordered()->get();
    });
    
    // Estadísticas del portafolio
    Route::get('/stats', function () {
        return [
            'total_projects' => Project::active()->count(),
            'total_skills' => Skill::active()->count(),
            'years_experience' => Experience::active()->min('start_date') ? 
                now()->diffInYears(Experience::active()->min('start_date')) : 0,
            'technologies_used' => Project::active()->pluck('technologies')->flatten()->unique()->count()
        ];
    });
});
