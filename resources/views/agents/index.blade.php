<x-dashboard-layout>
    
    <x-slot name="title">
        Agents
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Leads</li>
    </x-slot>

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped mt-4"> 
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agents as $agent)
            <tr>
                <td>{{ $agent->name }}</td>
                <td>{{ $agent->email }}</td>
                <td>
                    <a href="{{ route('agents.edit', $agent) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('agents.destroy', $agent) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('agents.create') }}" class="btn btn-primary mb-3">Add Agent</a>

    {{ $agents->links() }}
</div>
</x-dashboard-layout>