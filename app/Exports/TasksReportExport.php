<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;

class TasksReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::selectRaw('status, COUNT(*) as total')
        ->groupBy('status')
        ->get();
    }
    
    public function headings(): array
    {
        return [
            'Status',
            'Total Tasks',
        ];
    }
}
