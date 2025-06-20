<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get(); 
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id', // Validar que el rol existe
        ]);

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function show(User $user)
    {
        
        $projects = Project::all(); 
        $assignedProjects = $user->projects; 

        return Inertia::render('Users/Show', [
            'user' => $user,
            'projects' => $projects, 
            'assignedProjects' => $assignedProjects,
        ]);
    }

    public function assignProjects(Request $request, User $user)
    {
        $validated = $request->validate([
            'project_ids' => 'required|array', 
            'project_ids.*' => 'exists:projects,id', 
        ]);

        $user->projects()->syncWithoutDetaching($validated['project_ids']); 

        return back()->with('success', 'Proyectos asignados correctamente.');
    }

    public function removeProject(Request $request, User $user)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id', 
        ]);

        
        $user->projects()->detach($validated['project_id']);

        return back()->with('success', 'Proyecto eliminado correctamente.');
    }



}