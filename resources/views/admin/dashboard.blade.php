@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Painel Administrativo</h1>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Usuários</h5>
                    <p class="card-text display-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Tarefas</h5>
                    <p class="card-text display-4">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pendentes</h5>
                    <p class="card-text display-4">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Concluídas</h5>
                    <p class="card-text display-4">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Últimos Usuários</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentUsers as $user)
                            <li class="list-group-item">
                                {{ $user->name }} ({{ $user->email }})
                                <span class="float-right text-muted small">
                                    {{ $user->created_at->diffForHumans() }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Últimas Tarefas</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentTasks as $task)
                            <li class="list-group-item">
                                {{ $task->titulo }}
                                <span class="badge badge-{{ $task->status == 'concluida' ? 'success' : 'warning' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                                <span class="float-right text-muted small">
                                    {{ $task->created_at->diffForHumans() }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection