@if(request()->has('export') && request()->export == 'pdf')
    <!DOCTYPE html>
    <html>
    <head>
        <title>Task Reports</title>
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
                background: #ffc107;
                color: black;
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
                    <th>Status</th>
                    <th>Total Tasks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $task)
                    <tr>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->total }}</td>
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
                background: #ffc107;
                color: black;
            }
            tr:hover {
                background: #f1f1f1;
            }
        </style>

        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Total Tasks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $task)
                    <tr>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('reports.tasks', ['export' => 'pdf']) }}" class="btn btn-primary">Export to PDF</a>
        <a href="{{ route('reports.tasks', ['export' => 'excel']) }}" class="btn btn-success">Export to Excel</a>


    </x-dashboard-layout>
@endif
