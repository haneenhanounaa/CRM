<x-dashboard-layout>
    
    <x-slot name="title">
        Leads
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Leads</li>
    </x-slot>
<div class="container">
    <h1>Add New Lead</h1>
    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        
        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select class="form-control" id="priority" name="priority">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>
        @if(auth()->user()->role === 'super_manager')
        <div class="mb-3">
        <label for="agent_id" class="form-label">Assign to Agent</label>
            <select class="form-control" id="agent_id" name="agent_id">
                <option value="">Select an Agent</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}" {{ isset($lead) && $lead->agent_id == $agent->id ? 'selected' : '' }}>
                        {{ $agent->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
</x-dashboard-layout>