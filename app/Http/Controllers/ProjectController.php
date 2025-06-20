<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectController extends Controller
{

    public function index(){
        $user = Auth::user();
        $role = $user->role->name;

    
        if($user->role_id === 1) {
            $projects = Project::all();
        }else {
        
            $projects = $user->projects;
        }

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'userRole' => $role,
        ]);
    }

    public function show(Project $project)
    {
        $user = Auth::user();
        $role = $user->role->name;
        $project->load(['tasks', 'tasks.assignedUser']);
        
        return Inertia::render('Projects/Show', [
            'project' => $project,
            'userRole' => $role,
        ]);
    }

    public function create()
    {
        return Inertia::render('Projects/Create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Activo,Pausado,Terminado',
        ]);
    
        Project::create($validated);
    
        return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente.');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', [
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Activo,Pausado,Terminado',
        ]);
    
        $project->update($validated);
    
        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente.');
    }

}