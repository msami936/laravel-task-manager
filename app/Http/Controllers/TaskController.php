<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        
        $query = Task::with('project')->orderBy('priority');
        
        if ($projectId) {
            $query->where('project_id', $projectId);
        }
        
        $tasks = $query->get();
        $projects = Project::withCount('tasks')->get();
        
        return view('tasks.index', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ]);

        $maxPriority = Task::where('project_id', $request->project_id)->max('priority') ?? 0;
        
        Task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'priority' => $maxPriority + 1,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('project')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'name' => $request->name,
            'project_id' => $request->project_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    /**
     * Update task priorities for drag and drop reordering.
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'tasks' => 'required|array',
            'tasks.*.id' => 'required|exists:tasks,id',
            'tasks.*.priority' => 'required|integer|min:1',
        ]);

        foreach ($request->tasks as $taskData) {
            Task::where('id', $taskData['id'])->update(['priority' => $taskData['priority']]);
        }

        return response()->json(['message' => 'Tasks reordered successfully']);
    }
}
