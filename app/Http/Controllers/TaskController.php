<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $rules = [];
    public $projects;

    public function __construct()
    {
        $this->projects = Project::all('id', 'project_name');

        $this->rules = [
            'project_id' => ['required', 'integer'],
            'task_name' => 'required|string|max:255',
        ];
    }

    public function index(Request $request)
    {
        $search = $request->filter;
        $tasks = Task::query()
            ->when($search, function ($query, $search) {
                return $query
                    ->where('project_id', $search);
            })
            ->orderBy('priority', 'asc')
            ->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'projects' => $this->projects,
            'totalTasks' => Task::count(),
        ]);
    }

    public function create()
    {
        return view('tasks.create', [
            'projects' => $this->projects,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules);

        $validatedData['priority'] = Task::count() + 1;

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'projects' => $this->projects,
            'task' => $task,
        ]);
    }

    public function update(Task $task, Request $request)
    {
        $validatedData = $request->validate($this->rules);

        Task::where('id', $task->id)->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task Updated Successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task Deleted Successfully');
    }

    public function status(Task $task)
    {
        if ($task->status == false) {
            $status = true;
        } else {
            $status = false;
        }

        Task::where('id', $task->id)
            ->update(['status' => $status]);
        
        return back()->with('success', 'Task Updated Successfully');
    }

    public function priority(Request $request)
    {
        for ($i=0; $i < sizeof($request->data) ; $i++) { 
            Task::find($request->data[$i])
                ->update([
                    'priority' => $i + 1,
                ]);
        }
        
        return response('Priority Updated Successfully', 200);
    }
}
