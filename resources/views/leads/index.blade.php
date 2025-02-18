<x-dashboard-layout>
    
    <x-slot name="title">
        Leads
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Leads</li>
    </x-slot>

<div class="container">
    <a href="{{ route('leads.create') }}" class="btn btn-primary mb-3">Add New Lead</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Stage</th>
                <th>Priority</th>
                <th>Assigned Agent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->email }}</td>
                    <td>{{ $lead->phone }}</td>
                    {{-- <td>{{ ucfirst($lead->stage_id) }}</td> --}}
                    <td>{{ $lead->stage->name ?? 'No Specific Stage' }}</td>

                    <td>{{ ucfirst($lead->priority) }}</td>
                    <td>{{ $lead->agent->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('leads.show', $lead) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('leads.edit', $lead) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('leads.destroy', $lead) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $leads->links() }}
</div>
</x-dashboard-layout>