<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth'); // Solo usuarios autenticados pueden acceder
        //$this->middleware(['auth', 'admin'])->only(['create', 'store', 'destroy']); // Solo admin puede crear y eliminar tareas
    }

    /**
     * Mostrar todas las tareas.
     */
    public function index()
    {
        // Los administradores ven todas las tareas, los usuarios solo las suyas
        $tasks = Auth::user()->role === 'admin' ? Task::all() : Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Mostrar formulario para crear tarea (solo administradores).
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Guardar una nueva tarea (solo administradores).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id', // El admin debe asignar la tarea a un usuario
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'waiting',
            'project_id' => $request->project_id,
            'user_id' => $request->user_id, // Ahora el admin asigna la tarea
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito.');
    }

    /**
     * Mostrar una tarea específica.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Mostrar formulario para editar tarea (solo si el usuario es el asignado).
     */
    public function edit(Task $task)
    {
        if (Auth::user()->role !== 'admin' && Auth::id() !== $task->user_id) {
            return redirect()->route('tasks.index')->with('error', 'No tienes permisos para editar esta tarea.');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualizar una tarea (el admin puede actualizar todo, el usuario solo el estado).
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::user()->role === 'admin') {
            // Admin puede actualizar todo
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:waiting,in process,completed',
                'user_id' => 'required|exists:users,id',
            ]);
            $task->update($request->only(['name', 'description', 'status', 'user_id']));
        } else {
            // Usuario solo puede cambiar el estado
            $request->validate([
                'status' => 'required|in:waiting,in process,completed',
            ]);

            if ($task->user_id !== Auth::id()) {
                return redirect()->route('tasks.index')->with('error', 'No puedes modificar esta tarea.');
            }

            $task->update($request->only(['status']));
        }

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada con éxito.');
    }

    /**
     * Eliminar una tarea (solo administradores).
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada con éxito.');
    }
}
