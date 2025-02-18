<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgentPerformanceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'agent')
        ->withCount(['leads', 'tasks'])
        ->get();
        }

    public function headings(): array
    {
            return [
                'Agent Name',
                'Total Leads',
                'Total Tasks',
            ];
    }    
}

