@extends('layouts.app')

@section('title', 'Minhas Tarefas')

@push('styles')
<style>
  body { background: #eaf4fc; } /* Azul bem claro */

  /* Container “caderno” */
  .tasks-container {
    max-width: 900px;
    margin: 2rem auto;
    font-family: 'Georgia', serif;
    background: #fff;
    padding: 2rem 2rem 2rem 3rem;
    border: 2px solid #b0d4f1;
    box-shadow: 0 0 20px rgba(0,0,50,0.05);
    position: relative;
    background-image: repeating-linear-gradient(
      to bottom,
      #ffffff, #ffffff 24px,
      #dceefb 24px, #dceefb 25px
    );
    background-size: 100% 25px;
    background-position: 0 1rem;
    border-radius: 0 12px 12px 0;
  }
  .tasks-container::before {
    content: "";
    position: absolute; left: 0; top: 0; bottom: 0; width: 30px;
    background: repeating-linear-gradient(
      to bottom,
      #b0d4f1, #b0d4f1 10px,
      #89bde3 10px, #89bde3 11px
    );
    border-right: 2px solid #89bde3;
  }

  h2 {
    text-align: center;
    color: #3a6ea5;
    margin-bottom: 1.8rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    font-size: 1.8rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #b0d4f1;
  }

  /* Filtros */
  .filters {
    display: flex; gap: 1rem; justify-content: center;
    margin-bottom: 2rem; flex-wrap: wrap;
    padding-bottom: 1rem; border-bottom: 1px solid #b0d4f1;
  }
  .filters input, .filters select {
    padding: 0.6rem 1rem;
    border: 1px solid #b0d4f1;
    border-radius: 4px;
    font-size: 0.95rem;
    background: #fff;
    color: #3a6ea5;
  }
  .filters input:focus, .filters select:focus {
    outline: none;
    border-color: #3a6ea5;
    box-shadow: 0 0 0 2px rgba(58,110,165,0.2);
  }
  .filters button {
    background: #3a6ea5;
    color: #fff;
    border: none;
    padding: 0.6rem 1.6rem;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
  }
  .filters button:hover { background: #2c5a8a; }

  /* Tabela simples */
  table {
    width: 100%; border-collapse: collapse;
    border: 1px solid #b0d4f1; margin-bottom: 1.5rem;
  }
  thead {
    background: #dceefb; color: #3a6ea5;
    border-bottom: 2px solid #b0d4f1;
  }
  th, td {
    padding: 0.9rem 1.2rem; vertical-align: middle;
    border-right: 1px solid #e0f0fb;
  }
  th:last-child, td:last-child { border-right: none; }
  tbody tr:nth-child(odd) { background: #f6fbff; }
  tbody tr:hover { background: #e0f0fb; }

  /* Status */
  .status {
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    color: #fff;
    text-transform: capitalize;
    transition: transform 0.2s;
    display: inline-block;
  }
  .status.pendente  { background: #ff0d39; }
  .status.andamento { background: #ffbb00; }
  .status.concluida { background: #0ea213; }
  .status:hover     { transform: scale(1.05); }

  /* Ações */
  .actions button {
    background: #fff;
    border: 1px solid #b0d4f1;
    border-radius: 4px;
    color: #3a6ea5;
    cursor: pointer;
    padding: 0.4rem;
    transition: background 0.25s;
  }
  .actions button:hover {
    background: #e0f0fb; color: #2c5a8a;
  }

  /* Paginação */
  .pagination a, .pagination span {
    padding: 0.4rem 0.9rem;
    margin: 0 0.2rem;
    border: 1px solid #b0d4f1;
    border-radius: 4px;
    color: #3a6ea5;
    background: #fff;
  }
  .pagination a:hover { background: #e0f0fb; }
  .pagination .active {
    background: #3a6ea5; color: #fff;
  }

  .no-tasks {
    text-align: center;
    font-style: italic;
    color: #3a6ea5;
    padding: 1.5rem;
    background: #f6fbff;
    border: 1px solid #b0d4f1;
    border-radius: 4px;
  }
</style>
@endpush

@section('content')
  <div class="tasks-container" role="main">
    <h2>Minhas Tarefas</h2>

    <form method="GET" action="{{ route('tasks.index') }}" class="filters">
      <input type="text" name="search" placeholder="Buscar título..." value="{{ request('search') }}">
      <select name="status">
        <option value="">Todos os Status</option>
        <option value="pendente"  {{ request('status')=='pendente'  ? 'selected':'' }}>Pendente</option>
        <option value="andamento" {{ request('status')=='andamento' ? 'selected':'' }}>Andamento</option>
        <option value="concluida" {{ request('status')=='concluida' ? 'selected':'' }}>Concluída</option>
      </select>
      <button type="submit">Filtrar</button>
    </form>

    @if($tasks->count())
      <table role="table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
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
      <p class="no-tasks">Nenhuma tarefa encontrada. Que tal criar uma?</p>
    @endif
  </div>

  {{-- FontAwesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
