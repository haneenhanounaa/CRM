<x-dashboard-layout>
    
    <x-slot name="title">
        Stages
        
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Stages</li>
    </x-slot>

<div class="container">
    <h1>Stages</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order</th>
                <th>Stage Name</th>
                <th>Description</th>
                <th>Leads Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stages as $stage)
                <tr>
                    <td>{{ $stage->order }}</td>
                    <td>{{ $stage->name }}</td>
                    <td>{{ $stage->description }}</td>
                    <td>{{ $stage->leads_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-dashboard-layout>
