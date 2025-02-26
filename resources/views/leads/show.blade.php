<x-dashboard-layout>
    
    <x-slot name="title">
        Leads
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Leads</li>
    </x-slot>

<div class="container">
    <h1>Lead Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $lead->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $lead->email }}</p>
            <p class="card-text"><strong>Phone:</strong> {{ $lead->phone }}</p>
            <p class="card-text"><strong>Stage:</strong> {{ $lead->stage->name ?? 'New'}}</p>
            <p class="card-text"><strong>Priority:</strong> {{ ucfirst($lead->priority) }}</p>
            <p class="card-text"><strong>Assigned Agent:</strong> {{ $lead->agent->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Notes:</strong> {{ $lead->notes }}</p>
        </div>
    </div>
    <a href="{{ route('leads.edit', $lead) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('leads.index') }}" class="btn btn-secondary mt-3">Back to Leads</a>
    {{-- <a href="{{ route('leads.changeStage', $lead) }}" class="btn btn-primary mt-3">Change Stage</a> --}}

</div>
</x-dashboard-layout>
