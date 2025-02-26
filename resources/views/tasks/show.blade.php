<x-dashboard-layout>
    
    <x-slot name="title">
        Tasks
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tasks</li>
    </x-slot>

<div class="container">
    <h1 class="mb-4">Task Details</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $task->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Agent:</strong> {{ $task->agent->name ?? 'N/A' }}</p>
            <p><strong>Lead:</strong> {{ $task->lead->name ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
        </div>
    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back to Tasks</a>
</div>
</x-dashboard-layout>