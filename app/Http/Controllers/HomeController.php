<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProjects = Project::active()->featured()->orderBy('order')->take(6)->get();
        $skills = Skill::active()->ordered()->get()->groupBy('category');
        $experiences = Experience::active()->ordered()->take(5)->get();

        return view('pages.home', compact('featuredProjects', 'skills', 'experiences'));
    }

    public function about(): View
    {
        $skills = Skill::active()->ordered()->get()->groupBy('category');
        $experiences = Experience::active()->ordered()->get();

        return view('pages.about', compact('skills', 'experiences'));
    }

    public function projects(Request $request): View
    {
        $query = Project::active()->orderBy('order');

        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        if ($request->has('technology')) {
            $query->whereJsonContains('technologies', $request->technology);
        }

        $projects = $query->paginate(12);
        $categories = Project::active()->distinct()->pluck('category');
        $technologies = $this->getAllTechnologies();

        return view('pages.projects', compact('projects', 'categories', 'technologies'));
    }

    private function getAllTechnologies(): array
    {
        $technologies = Project::active()->pluck('technologies')->flatten()->unique()->sort()->values();
        return $technologies->toArray();
    }
}
