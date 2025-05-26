@extends('layouts.admin')

@section('title', 'Tarefas - Administração')

@section('content')
    <h1>Tarefas de Todos os Usuários</h1>

    <form method="GET" action="{{ route('admin.tasks.index') }}" class="mb-4">
        <input type="text" name="titulo" placeholder="Buscar por título" value="{{ old('titulo', $tituloFiltro) }}">
        
        <select name="status">
            <option value="">Todos os status</option>
            @foreach($statusValidos as $status)
                <option value="{{ $status }}" @if($status == $statusFiltro) selected @endif>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <button type="submit">Filtrar</button>
        <a href="{{ route('admin.tasks.index') }}">Limpar</a>
    </form>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Status</th>
                <th>Usuário</th>
                <th>Criado em</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->titulo }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->user->name ?? '—' }}</td>
                    <td>{{ $task->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhuma tarefa encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $tasks->withQueryString()->links() }}
    </div>
@endsection
