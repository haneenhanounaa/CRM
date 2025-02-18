<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reports/leads-by-stage', [ReportController::class, 'leadsByStage'])->name('reports.leads_by_stage');
Route::get('/reports/agent-performance', [ReportController::class, 'agentPerformance'])->name('reports.agent_performance');
Route::get('/reports/tasks', [ReportController::class, 'tasksReport'])->name('reports.tasks');
Route::get('/reports/custom', [ReportController::class, 'customReport'])->name('reports.custom');




Route::middleware(['auth', RoleMiddleware::class . ':super_manager'])->group(function () {
    Route::resource('agents', AgentController::class);//  بس رح يدير الكونترولر Super Manager
    Route::resource('tasks', TaskController::class);
});

Route::get('tasks/{task}/solve', [TaskController::class, 'solve'])->name('tasks.solve');
Route::post('tasks/{task}/solve', [TaskController::class, 'submitSolve'])->name('tasks.submitSolve');

Route::middleware(['auth'])->group(function () {
    Route::resource('leads', LeadController::class);
    Route::get('/leads/{lead}/change-stage', [LeadController::class, 'changeStage'])->name('leads.changeStage');
    Route::put('/leads/{lead}/update-stage', [LeadController::class, 'updateStage'])->name('leads.updateStage');

    
});

Route::get('/stages', [StageController::class, 'index'])->name('stages.index');


Route::get('/dashboard', [DashboardController::class,'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
