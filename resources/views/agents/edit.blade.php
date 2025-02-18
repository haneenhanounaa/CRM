<x-dashboard-layout>
    
    <x-slot name="title">
        Leads
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Leads</li>
    </x-slot>

<div class="container">
    <h1 class="mb-4">Edit Agent</h1>
    <form action="{{ route('agents.update', $agent) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $agent->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $agent->email) }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</x-dashboard-layout>
