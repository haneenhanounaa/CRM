<x-dashboard-layout>
    
    <x-slot name="title">
        Tasks
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tasks</li>
    </x-slot>

<div class="container">
    <h1 class="mb-4">Edit Task</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="agent_id" class="form-label">Agent</label>
            <select name="agent_id" id="agent_id" class="form-control" required>
                <option value="">Select Agent</option>
                @foreach ($agents as $agent)
                    <option value="{{ $agent->id }}" {{ old('agent_id', $task->agent_id) == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="lead_id" class="form-label">Lead</label>
            <select name="lead_id" id="lead_id" class="form-control">
                <option value="">Select Lead</option>
                @foreach ($leads as $lead)
                    <option value="{{ $lead->id }}" {{ old('lead_id', $task->lead_id) == $lead->id ? 'selected' : '' }}>{{ $lead->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
</x-dashboard-layout>