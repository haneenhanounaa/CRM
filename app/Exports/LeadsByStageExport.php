<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadsByStageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lead::with('stage')
                    ->selectRaw('stage_id, COUNT(*) as total')
                    ->groupBy('stage_id')
                    ->with('stage')
                    ->get();

    }

    public function headings(): array
    {
        return [
            'Stage ID',
            'Total Leads',
        ];
    }
}
