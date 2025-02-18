<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeadsByStageExport;
use App\Exports\AgentPerformanceExport;
use App\Exports\TasksReportExport;
use App\Exports\CustomReportExport;

class ReportController extends Controller
{
    // Leads by stage report
    public function leadsByStage(Request $request) {

        $data = Lead::with('stage')
            ->selectRaw('stage_id, COUNT(*) as total')
            ->groupBy('stage_id')
            ->with('stage')
            ->get();

        if ($request->has('export') && $request->export == 'pdf') {
            return $this->downloadReport(
                'reports.leads_by_stage', // View name
                compact('data'), // Data to pass to the view
                'leads_by_stage_report' // Custom filename
            );
        }
        if ($request->has('export')) {
            return Excel::download(new LeadsByStageExport(), 'leads_by_stage.xlsx');
        }

                    
        return view('reports.leads_by_stage', compact('data'));
    }

    public function agentPerformance(Request $request)
    {
        $data = User::where('role',
            'agent'
        ) // Only fetch users with the 'agent' role
        ->withCount(['leads', 'tasks']) // Count leads and tasks related to each agent
        ->get();

        if ($request->has('export') && $request->export == 'pdf') {
            return $this->downloadReport(
                'reports.agent_performance',
                compact('data'),
                'agent_performance_report'
            );
        }

        if ($request->has('export')) {
            return Excel::download(new AgentPerformanceExport(), 'agent_performance.xlsx');
        }

        return view('reports.agent_performance', compact('data'));
    }

    //Open and Completed Tasks Report
    public function tasksReport(Request $request) {
        
        $data = Task::selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->get();

        if ($request->has('export') && $request->export == 'pdf') {
            return $this->downloadReport(
                'reports.tasks_report',
                compact('data'),
                'tasks_report'
            );   
        }  
        if ($request->has('export')) {
            return Excel::download(new TasksReportExport(), 'tasks_report.xlsx');
        }

        return view('reports.tasks_report', compact('data'));
    }


    
    public function customReport(Request $request)
    {
        $query = Lead::query();

        if ($request->has('user_id') && $request->input('user_id') !== ''
        ) {
            $query->where('agent_id',
                $request->input('user_id')
            );
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [
                $request->input('start_date'),
                $request->input('end_date'),
            ]);
        }

        $data = $query->with('agent')->get();
        $agents = User::where('role',
            'agent'
        )->get();

        if ($request->has('export') && $request->export == 'pdf') {
            return $this->downloadReport(
                'reports.custom_report_pdf',
                compact('data', 'agents'),
                'custom_report'
            );
        }
        
        if ($request->has('export')) {
            return Excel::download(new CustomReportExport(
                $request->input('user_id'),
                $request->input('start_date'),
                $request->input('end_date')
            ), 'custom_report.xlsx');
        }

        
        return view('reports.custom',
            compact('data', 'agents')
        );

    }

    protected function downloadReport(string $view, array $data, string $filename)
    {
        $pdf = Pdf::loadView($view, $data);
        return $pdf->download("{$filename}.pdf");
    }

}
