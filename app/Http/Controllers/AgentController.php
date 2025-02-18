<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * // Display a list of agents

     */
    public function index()
    {
        $agents = User::where('role', 'Agent')->paginate(10);
        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *     // Show the form for creating a new agent

     */
    public function create()
    {
        //
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     * // Store a newly created agent in the database
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'Agent',
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('agents.index')->with('success', 'Agent added successfully.');
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
     *     // Show the form for editing an existing agent

     */
    public function edit(User $agent)
    {
        //
        return view('agents.edit', compact('agent'));

    }

    /**
     * Update the specified resource in storage.
     *     // Update an agent's information

     */
    public function update(Request $request, User $agent)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $agent->id,
        ]);

        $agent->update($request->only(['name', 'email']));

        return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *     // Delete an agent

     */
    public function destroy(User $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
