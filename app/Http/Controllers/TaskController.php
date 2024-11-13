<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;



class TaskController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->tasks()->orderBy('created_at', 'desc');
    
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
    
        if ($request->has('priority') && $request->priority !== '') {
            $query->where('priority', $request->priority);
        }
    
        $tasks = $query->get();
    
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $task = new Task([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? false,
            'priority' => $request->priority,
        ]);
    
        Auth::user()->tasks()->save($task);
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
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
    public function edit(Task $task)
    {
       
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized action.');
        }
    
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized action.');
        }
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $task->fill([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? false,
            'priority' => $request->priority,
        ])->save();
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
      
        // $this->authorize('delete', $task);  // This checks if the user can delete the task
        if (Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
