<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::with('category')
            ->orderBy('order')
            ->orderBy('name')
            ->paginate(20);

        $categories = SkillCategory::active()->ordered()->get();

        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create(): View
    {
        $categories = SkillCategory::active()->ordered()->get();

        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:skill_categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'new_category_color' => 'nullable|string|max:7',
            'new_category_icon' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Manejar categoría
        if ($request->filled('new_category_name')) {
            // Crear nueva categoría
            $category = SkillCategory::create([
                'name' => $validated['new_category_name'],
                'slug' => Str::slug($validated['new_category_name']),
                'color' => $validated['new_category_color'] ?? '#3B82F6',
                'icon' => $validated['new_category_icon'] ?? \App\Helpers\IconHelper::getDefaultIcon(),
                'order' => SkillCategory::max('order') + 1,
                'is_active' => true,
            ]);
            $validated['category_id'] = $category->id;
        }

        // Remover campos de nueva categoría del array validado
        unset($validated['new_category_name'], $validated['new_category_color'], $validated['new_category_icon']);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Habilidad creada exitosamente.');
    }

    public function show(Skill $skill): View
    {
        $skill->load('category');
        return view('admin.skills.show', compact('skill'));
    }

    public function edit(Skill $skill): View
    {
        $categories = SkillCategory::active()->ordered()->get();

        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:skill_categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'new_category_color' => 'nullable|string|max:7',
            'new_category_icon' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Manejar categoría
        if ($request->filled('new_category_name')) {
            // Crear nueva categoría
            $category = SkillCategory::create([
                'name' => $validated['new_category_name'],
                'slug' => Str::slug($validated['new_category_name']),
                'color' => $validated['new_category_color'] ?? '#3B82F6',
                'icon' => $validated['new_category_icon'] ?? \App\Helpers\IconHelper::getDefaultIcon(),
                'order' => SkillCategory::max('order') + 1,
                'is_active' => true,
            ]);
            $validated['category_id'] = $category->id;
        }

        // Remover campos de nueva categoría del array validado
        unset($validated['new_category_name'], $validated['new_category_color'], $validated['new_category_icon']);

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
