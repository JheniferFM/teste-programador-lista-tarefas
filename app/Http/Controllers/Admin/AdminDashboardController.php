<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(): View
    {
        $totalUsers = User::count();
        $totalTasks = Task::count();
        
        $taskStats = Task::selectRaw('
            count(*) as total,
            sum(case when status = "pendente" then 1 else 0 end) as pending,
            sum(case when status = "concluida" then 1 else 0 end) as completed
        ')->first();

        $recentUsers = User::latest()->take(5)->get();
        $recentTasks = Task::latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $taskStats->pending,
            'completedTasks' => $taskStats->completed,
            'recentUsers' => $recentUsers,
            'recentTasks' => $recentTasks
        ]);
    }
}