<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // Listar todas as tarefas, com filtros por status e título, paginadas
    public function index(Request $request)
    {
        $query = Task::with('user'); // eager load do usuário

        $statusValidos = ['pendente', 'andamento', 'concluida'];

        if ($request->filled('status') && in_array($request->status, $statusValidos)) {
            $query->where('status', $request->status);
        }

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.tasks.index', [
            'tasks' => $tasks,
            'statusFiltro' => $request->status ?? '',
            'tituloFiltro' => $request->titulo ?? '',
            'statusValidos' => $statusValidos,
        ]);
    }
}
