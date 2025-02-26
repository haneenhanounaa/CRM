<x-dashboard-layout>
    
    <x-slot name="title">
        Tasks
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tasks</li>
    </x-slot>

<div class="container">
    <h1 class="mb-4">Solve Task</h1>

    <div class="card mb-3">
        <div class="card-header">
            <h2>{{ $task->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Lead:</strong> {{ $lead->name }}</p> <!-- Display the lead's name -->
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
            
        </div>
    </div>

    <form action="{{ route('tasks.submitSolve', $task->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="stage_id" class="form-label">Update Lead Stage</label>
            <select name="stage_id" id="stage_id" class="form-control" required>
                <option value="">Select Stage</option>
                @foreach ($stages as $stage)
                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
</x-dashboard-layout>
