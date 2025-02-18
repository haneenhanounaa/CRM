<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::withCount('leads')->ordered()->get();
        return view('stages.index', compact('stages'));
    }
}
