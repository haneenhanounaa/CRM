<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomReportExport implements FromCollection, WithHeadings
{
    protected $user_id;
    protected $start_date;
    protected $end_date;

    public function __construct($user_id, $start_date, $end_date)
    {
        $this->user_id = $user_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = Lead::query();

        if ($this->user_id) {
            $query->where('agent_id', $this->user_id);
        }

        if ($this->start_date && $this->end_date) {
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }

        return $query->with('agent')->get();
    }

    public function headings(): array
    {
        return [
            'Lead ID',
            'Agent Name',
            'Created At',
        ];
    }
}
