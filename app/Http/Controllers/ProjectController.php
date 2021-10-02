<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(20);

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
        ]);

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project Created Successfully');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project,
        ]);
    }

    public function update(Project $project, Request $request)
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
        ]);

        Project::where('id', $project->id)
            ->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project Updated Successfully');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project Deleted Successfully');
    }
}
