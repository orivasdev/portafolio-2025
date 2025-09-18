<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => [
                'total' => Project::count(),
                'active' => Project::active()->count(),
                'featured' => Project::featured()->count(),
            ],
            'skills' => [
                'total' => Skill::count(),
                'active' => Skill::active()->count(),
                'by_category' => Skill::active()
                    ->selectRaw('category, COUNT(*) as count')
                    ->groupBy('category')
                    ->pluck('count', 'category')
                    ->toArray(),
            ],
            'experiences' => [
                'total' => Experience::count(),
                'active' => Experience::active()->count(),
                'current' => Experience::current()->count(),
            ],
            'contacts' => [
                'total' => Contact::count(),
                'unread' => Contact::where('status', 'unread')->count(),
                'read' => Contact::where('status', 'read')->count(),
                'replied' => Contact::where('status', 'replied')->count(),
            ],
        ];

        // Obtener contactos recientes no leídos
        $recentContacts = Contact::where('status', 'unread')
            ->latest()
            ->take(5)
            ->get();

        // Obtener proyectos recientes
        $recentProjects = Project::active()
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentProjects'));
    }
}
