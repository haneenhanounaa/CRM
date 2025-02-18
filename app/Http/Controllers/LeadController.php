<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('agent')->paginate(10);
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        
        Gate::authorize('create', Lead::class);

        $agents = User::where('role', 'agent')->get(); // Retrieve all agents
        return view('leads.create', compact('agents'));
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User|null $user */
        
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        Gate::authorize('create', Lead::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'required|string',
            'priority' => 'required|string',
            'agent_id' => 'nullable|exists:users,id',

        ]);
      

        // Automatically assign the creator's agent ID if they're an agent
        if (auth()->user()?->role === 'agent') {
            $request->merge(['agent_id' => auth()->id()]);
        }
        // Ensure super managers assign an agent
        if (auth()->user()?->role === 'super_manager' && !$request->filled('agent_id')) {
            return back()->withErrors(['agent_id' => 'An agent must be assigned to the lead.']);
        }

        Lead::create($request->all());

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    public function show(Lead $lead)
    {
        Gate::authorize('view', $lead);

        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        Gate::authorize('update', $lead);

        $agents = User::where('role', 'agent')->get(); // Retrieve all agents
        return view('leads.edit', compact('lead', 'agents'));   
     }

    public function update(Request $request, Lead $lead)
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
        Gate::authorize('update', $lead);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'required|string',
            // 'status' => 'required|string', // stage_id
            'priority' => 'required|string',
            'agent_id' => 'nullable|exists:users,id',

        ]);

        // Super manager must ensure an agent is assigned
          if (auth()->user()?->role === 'super_manager' && !$request->filled('agent_id')) {
          return back()->withErrors(['agent_id' => 'An agent  must be assigned to the lead.']);
    }


        $lead->update($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy(Lead $lead)
    {
        Gate::authorize('delete',$lead);
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }

    public function changeStage(Lead $lead)
    {
        $stages = Stage::orderBy('order')->get();
        return view('leads.change-stage', compact('lead', 'stages'));
    }

    public function updateStage(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'stage_id' => 'required|exists:stages,id',
        ]);

        $lead->update(['stage_id' => $validated['stage_id']]);
        return redirect()->route('leads.show', $lead)->with('success', 'Stage updated successfully.');
    }
}


