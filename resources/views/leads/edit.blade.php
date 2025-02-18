<x-dashboard-layout>
    
    <x-slot name="title">
        Leads
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Leads</li>
    </x-slot>
<div class="container">
    <h1>Edit Lead</h1>
    <form action="{{ route('leads.update', $lead) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $lead->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $lead->email }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $lead->phone }}" required>
        </div>
        {{-- <div class="mb-3">
            <label for="stage_id" class="form-label">Stage</label>
            <select class="form-control" id="status" name="status">
                <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New</option>
                <option value="in_progress" {{ $lead->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="negotiated" {{ $lead->status === 'negotiated' ? 'selected' : '' }}>Negotiated</option>
                <option value="closed" {{ $lead->status === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div> --}}
        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select class="form-control" id="priority" name="priority">
                <option value="high" {{ $lead->priority === 'high' ? 'selected' : '' }}>High</option>
                <option value="medium" {{ $lead->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="low" {{ $lead->priority === 'low' ? 'selected' : '' }}>Low</option>
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
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-dashboard-layout>

