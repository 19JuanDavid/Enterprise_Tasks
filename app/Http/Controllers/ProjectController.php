<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth'); // Protege todas las rutas con autenticación
       // $this->middleware('role:admin')->except(['index', 'show']);

    }

    /**
     * Mostrar todos los proyectos.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Mostrar formulario de creación de proyectos (solo administradores).
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Guardar un nuevo proyecto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyecto creado con éxito.');
    }

    /**
     * Mostrar un solo proyecto.
     */
    public function show(Project $project)
    {
        $tasks = $project->tasks;
        return view('projects.show', compact('project' , 'tasks'));
    }

    /**
     * Mostrar formulario de edición (solo administradores).
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Actualizar un proyecto.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Solo permitir actualizar nombre y descripción
        $project->update($request->only(['name', 'description']));

        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado con éxito.');
    }

    /**
     * Eliminar un proyecto.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado con éxito.');
    }
}
