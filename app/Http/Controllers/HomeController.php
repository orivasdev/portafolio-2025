<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProjects = Project::active()->featured()->with('category')->orderBy('order')->take(6)->get();
        $skills = Skill::active()->with('category')->ordered()->get()->groupBy('category.name');
        $experiences = Experience::active()->ordered()->take(5)->get();

        return view('pages.home', compact('featuredProjects', 'skills', 'experiences'));
    }

    public function about(): View
    {
        $skills = Skill::active()->with('category')->ordered()->get()->groupBy('category.name');
        $experiences = Experience::active()->ordered()->get();

        return view('pages.about', compact('skills', 'experiences'));
    }

    public function projects(Request $request): View
    {
        $query = Project::active()->with('category')->orderBy('order');

        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        $projects = $query->paginate(12);
        $categories = Category::active()->ordered()->get();

        return view('pages.projects', compact('projects', 'categories'));
    }

}
