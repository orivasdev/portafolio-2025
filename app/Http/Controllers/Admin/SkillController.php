<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('category')
            ->orderBy('order')
            ->orderBy('name')
            ->paginate(20);

        $categories = Skill::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create(): View
    {
        $categories = Skill::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Habilidad creada exitosamente.');
    }

    public function show(Skill $skill): View
    {
        return view('admin.skills.show', compact('skill'));
    }

    public function edit(Skill $skill): View
    {
        $categories = Skill::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Habilidad actualizada exitosamente.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Habilidad eliminada exitosamente.');
    }

    public function toggleActive(Skill $skill): RedirectResponse
    {
        $skill->update(['is_active' => !$skill->is_active]);

        $status = $skill->is_active ? 'activada' : 'desactivada';
        
        return redirect()->back()
            ->with('success', "Habilidad {$status} exitosamente.");
    }
}
