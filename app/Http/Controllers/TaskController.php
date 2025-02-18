<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Stage;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['agent', 'lead'])->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = User::where('role', 'agent')->get(); // Fetch only agents
        $leads = Lead::all();
        return view('tasks.create', compact('agents', 'leads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'agent_id' => 'required|exists:users,id',
            'lead_id' => 'nullable|exists:leads,id',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);
    
        

        $task = Task::create($request->all());


        // Notify the assigned agent
        $agent = User::find($request->agent_id);
        // dd($agent);

        $agent->notify(new TaskAssigned($task));

        return redirect()->route('tasks.index')->with('success', 'Task created successfully , and the agent has been notified');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $agents = User::where('role', 'agent')->get(); // Fetch only agents
        $leads = Lead::all();
        return view('tasks.edit', compact('task', 'agents', 'leads'));   
     }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'agent_id' => 'required|exists:users,id',
            'lead_id' => 'nullable|exists:leads,id',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);
    
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');

    }

    public function solve(Task $task)
    {
        auth()->user()->unreadNotifications
         ->where('data->task_id', $task->id)->markAsRead();


    

        $stages = Stage::all(); 
        $lead = $task->lead;    // Retrieve the associated lead

        return view('tasks.solve', compact('task', 'stages','lead'));
    }

    public function submitSolve(Request $request, Task $task)
    {
        $validated = $request->validate([
            'stage_id' => 'required|exists:stages,id', // Ensure the selected stage is valid
        ]);
    
        // Update the lead's stage
        if ($task->lead) {
            $task->lead->update(['stage_id' => $validated['stage_id']]);
        }
    
        // Mark the task as completed
        $task->update(['status' => 'completed']);
    
        return redirect()->route('dashboard');
    }
}
