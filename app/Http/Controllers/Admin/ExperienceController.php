<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderBy('order')
            ->orderBy('start_date', 'desc')
            ->paginate(20);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create(): View
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full-time,part-time,freelance,internship,contract',
            'technologies_used' => 'nullable|array',
            'technologies_used.*' => 'string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_current'] = $request->has('is_current');
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        // Si es el trabajo actual, no debe tener fecha de fin
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        // Filtrar tecnologías vacías
        if (isset($validated['technologies_used'])) {
            $validated['technologies_used'] = array_filter($validated['technologies_used']);
        }

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experiencia creada exitosamente.');
    }

    public function show(Experience $experience): View
    {
        return view('admin.experiences.show', compact('experience'));
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full-time,part-time,freelance,internship,contract',
            'technologies_used' => 'nullable|array',
            'technologies_used.*' => 'string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_current'] = $request->has('is_current');
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        // Si es el trabajo actual, no debe tener fecha de fin
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        // Filtrar tecnologías vacías
        if (isset($validated['technologies_used'])) {
            $validated['technologies_used'] = array_filter($validated['technologies_used']);
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experiencia actualizada exitosamente.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experiencia eliminada exitosamente.');
    }

    public function toggleActive(Experience $experience): RedirectResponse
    {
        $experience->update(['is_active' => !$experience->is_active]);

        $status = $experience->is_active ? 'activada' : 'desactivada';
        
        return redirect()->back()
            ->with('success', "Experiencia {$status} exitosamente.");
    }

    public function toggleCurrent(Experience $experience): RedirectResponse
    {
        // Si se marca como actual, desmarcar todas las demás
        if (!$experience->is_current) {
            Experience::where('is_current', true)->update(['is_current' => false]);
        }

        $experience->update(['is_current' => !$experience->is_current]);

        $status = $experience->is_current ? 'marcada como actual' : 'desmarcada como actual';
        
        return redirect()->back()
            ->with('success', "Experiencia {$status} exitosamente.");
    }
}
