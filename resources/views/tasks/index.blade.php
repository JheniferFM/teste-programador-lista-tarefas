@extends('layouts.app')

@section('title', 'Minhas Tarefas')

@push('styles')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

  body { 
    background: linear-gradient(135deg, #d6eaf8, #aed6f1); 
    font-family: 'Georgia', serif;
  }

  .tasks-container {
    max-width: 900px;
    margin: 2rem auto;
    background: #fff;
    padding: 2.5rem 2.5rem 2.5rem 3.5rem;
    border: 3px solid #5dade2;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    position: relative;
    background-image: repeating-linear-gradient(
      to bottom,
      #ffffff, #ffffff 28px,
      #d6eaf8 28px, #d6eaf8 29px
    );
    background-size: 100% 29px;
    background-position: 0 1rem;
    border-radius: 0 20px 20px 0;
  }

  .tasks-container::before {
    content: "";
    position: absolute;
    left: 0; top: 0; bottom: 0; width: 35px;
    background: repeating-linear-gradient(
      to bottom,
      #5dade2, #5dade2 12px,
      #3498db 12px, #3498db 13px
    );
    border-right: 3px solid #3498db;
  }

  h2 {
    font-family: 'Pacifico', cursive;
    text-align: center;
    color: #21618c;
    margin-bottom: 2rem;
    font-size: 2.4rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 2px solid #c3e6cb;
    padding: 12px 18px;
    border-radius: 8px;
    margin-bottom: 1.8rem;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  }

  .filters {
    display: flex; 
    gap: 1rem; 
    justify-content: center;
    margin-bottom: 2rem; 
    flex-wrap: wrap;
    padding-bottom: 1rem; 
    border-bottom: 2px dashed #5dade2;
  }

  .filters input, .filters select {
    padding: 0.6rem 1rem;
    border: 2px solid #5dade2;
    border-radius: 6px;
    font-size: 1rem;
    transition: 0.3s;
    background: #fff;
    color: #21618c;
  }

  .filters input:focus, .filters select:focus {
    border-color: #21618c;
    box-shadow: 0 0 0 3px rgba(33,97,140,0.2);
  }

  .filters button {
    background: #21618c;
    color: #fff;
    border: none;
    padding: 0.7rem 1.7rem;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s, transform 0.1s;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  }

  .filters button:hover { 
    background: #154360; 
    transform: scale(1.05);
  }

  table {
    width: 100%; 
    border-collapse: collapse;
    border: 2px solid #5dade2; 
    margin-bottom: 2rem;
  }

  thead {
    background: #d6eaf8; 
    color: #21618c;
    border-bottom: 3px solid #5dade2;
  }

  th, td {
    padding: 1rem 1.2rem; 
    vertical-align: middle;
    border-right: 1px solid #ebf5fb;
  }

  th:last-child, td:last-child { 
    border-right: none; 
  }

  tbody tr:nth-child(odd) { 
    background: #f4faff; 
  }

  tbody tr:hover { 
    background: #ebf5fb; 
  }

  .status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    color: #fff;
    text-transform: capitalize;
    transition: transform 0.2s;
    display: inline-block;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

  .status.pendente  { background: #e74c3c; }
  .status.andamento { background: #f39c12; }
  .status.concluida { background: #27ae60; }

  .status:hover { 
    transform: scale(1.1) rotate(-2deg);
  }

  .actions button {
    background: #fff;
    border: 2px solid #5dade2;
    border-radius: 50%;
    color: #21618c;
    cursor: pointer;
    padding: 0.5rem;
    transition: 0.3s;
    font-size: 1rem;
    box-shadow: 0 3px 6px rgba(0,0,0,0.05);
  }

  .actions button:hover {
    background: #d6eaf8; 
    transform: scale(1.2);
  }

  .pagination a, .pagination span {
    padding: 0.5rem 1rem;
    margin: 0 0.3rem;
    border: 2px solid #5dade2;
    border-radius: 6px;
    color: #21618c;
    background: #fff;
    font-weight: 600;
  }

  .pagination a:hover { 
    background: #ebf5fb; 
  }

  .pagination .active {
    background: #21618c; 
    color: #fff;
  }

  .no-tasks {
    text-align: center;
    font-style: italic;
    color: #21618c;
    padding: 2rem;
    background: #f4faff;
    border: 2px dashed #5dade2;
    border-radius: 8px;
    font-size: 1.1rem;
  }
</style>
@endpush

@section('content')
  <div class="tasks-container" role="main">
    <h2>Minhas Tarefas</h2>

    @if (session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form method="GET" action="{{ route('tasks.index') }}" class="filters">
      <input type="text" name="titulo" placeholder="Buscar título..." value="{{ request('search') }}">
      <select name="status">
        <option value="">Todos os Status</option>
        <option value="pendente"  {{ request('status')=='pendente'  ? 'selected':'' }}>Pendente</option>
        <option value="andamento" {{ request('status')=='andamento' ? 'selected':'' }}>Andamento</option>
        <option value="concluida" {{ request('status')=='concluida' ? 'selected':'' }}>Concluída</option>
      </select>
      <button type="submit">
        <i class="fas fa-filter"></i> Filtrar
      </button>
    </form>

    @if($tasks->count())
      <table role="table">
        <thead>
          <tr>
            <th><i class="fas fa-heading"></i> Título</th>
            <th><i class="fas fa-align-left"></i> Descrição</th>
            <th><i class="fas fa-flag"></i> Status</th>
            <th><i class="fas fa-cogs"></i> Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tasks as $task)
          <tr>
            <td>{{ $task->titulo }}</td>
            <td>{{ Str::limit($task->descricao, 60) }}</td>
            <td>
              <span class="status {{ $task->status }}">{{ ucfirst($task->status) }}</span>
            </td>
            <td class="actions">
              <a href="{{ route('tasks.edit', $task) }}">
                <button type="button" title="Editar">
                  <i class="fas fa-pencil-alt"></i>
                </button>
              </a>
              <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline" onsubmit="return confirm('Excluir?')">
                @csrf @method('DELETE')
                <button type="submit" title="Excluir">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="pagination">
        {{ $tasks->appends(request()->query())->links() }}
      </div>
    @else
      <p class="no-tasks">
        Nenhuma tarefa encontrada... Que tal criar uma nova aventura? 🚀
      </p>
    @endif
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
