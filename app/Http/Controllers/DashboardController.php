<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Stage;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){    

        $leads=Lead::count();
        $stages = Stage::withCount('leads')->ordered()->get();
        $tasks = Task::get();

        
        return view('dashboard',compact('leads','stages','tasks'));
    }
    
}
