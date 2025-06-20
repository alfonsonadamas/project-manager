<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $users = User::all();
        return Inertia::render('Tasks/Create', [
            'project' => $project,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Alta,Media,Baja',
            'due_date' => 'required|date',
            'status' => 'required|in:Pendiente,En progreso,Hecha',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $validated['project_id'] = $project->id;

        Task::create($validated);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Tarea creada exitosamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        $users = User::all(); // Cargar los usuarios activos
        return Inertia::render('Tasks/Edit', [
            'project' => $project,
            'task' => $task,
            'users' => $users,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority' => 'required|in:Alta,Media,Baja',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:Pendiente,En progreso,Hecha',
            'assigned_to' => 'required|exists:users,id',
        ]);
    
        $task->update($validated);
    
        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Tarea actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Tarea eliminada correctamente');
    }   

}