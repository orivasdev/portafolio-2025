<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::with('category')->orderBy('order')->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $categories = Category::active()->ordered()->get();
        $maxOrder = Project::where('is_active', true)->max('order') ?? 0;
        $availableOrders = range(1, $maxOrder + 1);
        
        return view('admin.projects.create', compact('categories', 'availableOrders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'technologies' => 'required|array|min:1',
            'technologies.*' => 'string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'new_category_color' => 'nullable|string|max:7',
            'new_category_icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        // Filtrar tecnologías vacías
        $validated['technologies'] = array_filter($validated['technologies']);

        // Manejar categoría
        if ($request->filled('new_category_name')) {
            // Crear nueva categoría
            $category = Category::create([
                'name' => $validated['new_category_name'],
                'slug' => Str::slug($validated['new_category_name']),
                'color' => $validated['new_category_color'] ?? '#3B82F6',
                'icon' => $validated['new_category_icon'] ?? \App\Helpers\IconHelper::getDefaultIcon(),
                'order' => Category::max('order') + 1,
                'is_active' => true,
            ]);
            $validated['category_id'] = $category->id;
        }

        // Manejar ordenamiento
        $newOrder = $validated['order'] ?? (Project::max('order') + 1);
        $this->reorderProjects($newOrder, null);
        $validated['order'] = $newOrder;

        // Remover campos de nueva categoría del array validado
        unset($validated['new_category_name'], $validated['new_category_color'], $validated['new_category_icon']);

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto creado correctamente.');
    }

    public function edit(Project $project): View
    {
        $categories = Category::active()->ordered()->get();
        $maxOrder = Project::where('is_active', true)->max('order') ?? 0;
        $availableOrders = range(1, $maxOrder);
        
        return view('admin.projects.edit', compact('project', 'categories', 'availableOrders'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'technologies' => 'required|array|min:1',
            'technologies.*' => 'string|max:100',
            'category_id' => 'nullable|exists:categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'new_category_color' => 'nullable|string|max:7',
            'new_category_icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        // Filtrar tecnologías vacías
        $validated['technologies'] = array_filter($validated['technologies']);

        // Manejar categoría
        if ($request->filled('new_category_name')) {
            // Crear nueva categoría
            $category = Category::create([
                'name' => $validated['new_category_name'],
                'slug' => Str::slug($validated['new_category_name']),
                'color' => $validated['new_category_color'] ?? '#3B82F6',
                'icon' => $validated['new_category_icon'] ?? \App\Helpers\IconHelper::getDefaultIcon(),
                'order' => Category::max('order') + 1,
                'is_active' => true,
            ]);
            $validated['category_id'] = $category->id;
        }

        // Manejar ordenamiento
        $newOrder = $validated['order'] ?? $project->order;
        $oldOrder = $project->order;
        if ($newOrder != $oldOrder) {
            $this->reorderProjects($newOrder, $project->id, $oldOrder);
        }
        $validated['order'] = $newOrder;

        // Remover campos de nueva categoría del array validado
        unset($validated['new_category_name'], $validated['new_category_color'], $validated['new_category_icon']);

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    public function show(Project $project): View
    {
        $project->load('category');
        return view('admin.projects.show', compact('project'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        // Obtener el orden del proyecto antes de desactivarlo
        $deletedOrder = $project->order;
        
        // Eliminación lógica: marcar como inactivo
        $project->update(['is_active' => false]);

        // Reorganizar los órdenes de los proyectos activos restantes
        $this->reorderAfterDelete($deletedOrder);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyecto desactivado correctamente.');
    }

    public function toggleFeatured(Project $project): RedirectResponse
    {
        $project->update(['is_featured' => !$project->is_featured]);

        $status = $project->is_featured ? 'destacado' : 'no destacado';
        
        return redirect()->back()
            ->with('success', "Proyecto marcado como {$status} exitosamente.");
    }

    public function toggleActive(Project $project): RedirectResponse
    {
        $project->update(['is_active' => !$project->is_active]);

        $status = $project->is_active ? 'activado' : 'desactivado';
        
        return redirect()->back()
            ->with('success', "Proyecto {$status} exitosamente.");
    }

    /**
     * Restaurar un proyecto eliminado lógicamente
     */
    public function restore(Project $project): RedirectResponse
    {
        // Verificar que el proyecto esté inactivo
        if ($project->is_active) {
            return redirect()->back()
                ->with('error', 'El proyecto ya está activo.');
        }

        // Obtener el orden actual del proyecto
        $restoreOrder = $project->order;
        
        // Reactivar el proyecto
        $project->update(['is_active' => true]);

        // Reorganizar los órdenes para hacer espacio
        $this->reorderProjects($restoreOrder, $project->id, null);

        return redirect()->back()
            ->with('success', 'Proyecto restaurado correctamente.');
    }

    /**
     * Reordenar proyectos cuando se cambia la posición
     */
    private function reorderProjects(int $newOrder, ?int $projectId = null, ?int $oldOrder = null): void
    {
        if ($projectId && $oldOrder) {
            // Actualizando un proyecto existente
            if ($newOrder < $oldOrder) {
                // Moviendo hacia arriba: incrementar orden de proyectos activos entre newOrder y oldOrder
                Project::where('order', '>=', $newOrder)
                      ->where('order', '<', $oldOrder)
                      ->where('id', '!=', $projectId)
                      ->where('is_active', true)
                      ->increment('order');
            } else {
                // Moviendo hacia abajo: decrementar orden de proyectos activos entre oldOrder y newOrder
                Project::where('order', '>', $oldOrder)
                      ->where('order', '<=', $newOrder)
                      ->where('id', '!=', $projectId)
                      ->where('is_active', true)
                      ->decrement('order');
            }
        } else {
            // Creando un nuevo proyecto
            Project::where('order', '>=', $newOrder)
                  ->where('is_active', true)
                  ->increment('order');
        }
    }

    /**
     * Reorganizar órdenes después de eliminar un proyecto (solo proyectos activos)
     */
    private function reorderAfterDelete(int $deletedOrder): void
    {
        // Decrementar el orden de todos los proyectos activos que tenían un orden mayor al eliminado
        Project::where('order', '>', $deletedOrder)
              ->where('is_active', true)
              ->decrement('order');
    }
}
