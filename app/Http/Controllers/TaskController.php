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
        // Garante que só usuários autenticados possam acessar qualquer método deste controller
        $this->middleware('auth');
    }

    /**
     * Lista as tarefas do usuário logado, com filtros opcionais por título e status.
     */
    public function index(Request $request)
    {
        // Começa filtrando só as tarefas do usuário autenticado
        $query = Task::where('user_id', auth()->id());

        // Define quais status são válidos
        $statusValidos = ['pendente', 'andamento', 'concluida'];

        // Se o filtro de status estiver preenchido e for válido, aplica na consulta
        if ($request->has('status') && in_array($request->status, $statusValidos)) {
            $query->where('status', $request->status);
        }

        // Se o filtro de título estiver preenchido, aplica na consulta
        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        // Ordena as tarefas pela mais recente primeiro e pagina
        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

        // Retorna para a view passando as tarefas e filtros
        return view('tasks.index', [
            'tasks' => $tasks,
            'statusFiltro' => $request->status ?? '',
            'tituloFiltro' => $request->titulo ?? '',
        ]);
    }

    /**
     * Exibe o formulário para criar uma nova tarefa.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Armazena uma nova tarefa no banco, validando com StoreTaskRequest.
     */
    public function store(StoreTaskRequest $request)
    {
        // Cria a tarefa associando ao usuário logado
        Task::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);

        // Redireciona com mensagem de sucesso para a listagem
        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Exibe o formulário para editar uma tarefa, garantindo que o usuário tenha permissão.
     */
    public function edit(Task $task)
    {
        // Garante que só o dono da tarefa pode editar
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Atualiza uma tarefa, com validação e autorização.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Garante que só o dono da tarefa pode atualizar
        $this->authorize('update', $task);

        // Atualiza apenas os campos permitidos
        $task->update($request->only('titulo', 'descricao', 'status'));

        // Redireciona com mensagem de sucesso
        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Exclui uma tarefa do banco, com autorização.
     */
    public function destroy(Task $task)
    {
        // Garante que só o dono da tarefa pode excluir
        $this->authorize('delete', $task);

        $task->delete();

        // Redireciona com mensagem de sucesso
        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
