@if(request()->has('export') && request()->export == 'pdf')
    <!DOCTYPE html>
    <html>
    <head>
        <title>Custom Reports</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1rem;
            }
            th, td {
                padding: 0.75rem;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background: #007bff;
                color: white;
            }
            tr:hover {
                background: #f1f1f1;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Lead Name</th>
                    <th>Agent</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->agent->name }}</td>
                        <td>{{ $lead->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
@else
    <x-dashboard-layout>
        <x-slot name="title"> Reports </x-slot>
        <x-slot name="breadcrumb">
            <li class="breadcrumb-item">Reports</li>
        </x-slot>

        <style>
            form {
                margin-bottom: 2rem;
                background: #f9f9f9;
                padding: 1.5rem;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            label {
                font-weight: bold;
                margin-right: 0.5rem;
            }
            select, input[type="date"] {
                padding: 0.5rem;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-right: 1rem;
            }
            button {
                padding: 0.5rem 1rem;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background: #0056b3;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 1rem;
            }
            th, td {
                padding: 0.75rem;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background: #007bff;
                color: white;
            }
            tr:hover {
                background: #f1f1f1;
            }
        </style>

        <form method="GET" action="{{ route('reports.custom') }}">
            <label for="user_id">Agent:</label>
            <select name="user_id" id="user_id">
                <option value="">All</option>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach
            </select>

            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date">

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date">

            <button type="submit">Filter</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Lead Name</th>
                    <th>Agent</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->agent->name }}</td>
                        <td>{{ $lead->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('reports.custom', ['export' => 'pdf']) }}" class="btn btn-primary">Export to PDF</a>
        <a href="{{ route('reports.custom', ['export' => 'excel', 'user_id' => request('user_id'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success">Export to Excel</a>

    </x-dashboard-layout>
@endif
