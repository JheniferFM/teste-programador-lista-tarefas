<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function __construct()
    {
        // Garante que o usuário esteja autenticado para qualquer método
        $this->middleware('auth');
    }

    // Listar tarefas com filtro por título e status, só do usuário logado
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        $statusValidos = ['pendente', 'andamento', 'concluida'];

        if ($request->has('status') && in_array($request->status, $statusValidos)) {
            $query->where('status', $request->status);
        }

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'statusFiltro' => $request->status ?? '',
            'tituloFiltro' => $request->titulo ?? '',
        ]);
    }

    // Exibir formulário para criar tarefa
    public function create()
    {
        return view('tasks.create');
    }

    // Salvar nova tarefa com validação via StoreTaskRequest
    public function store(StoreTaskRequest $request)
    {
        Task::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    // Exibir formulário para editar tarefa com autorização
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    // Atualizar tarefa com validação via UpdateTaskRequest e autorização
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->only('titulo', 'descricao', 'status'));

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    // Excluir tarefa com autorização
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
