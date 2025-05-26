@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
  .dashboard-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 1rem;
    background: #ffffff;
    border: 2px solid #8ecae6;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    font-family: 'Segoe UI', sans-serif;
  }
  .dashboard-header {
    text-align: center;
    margin-bottom: 2rem;
  }
  .dashboard-header h2 {
    color: #023e8a;
    font-size: 2rem;
  }
  .stats {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
  }
  .stat-card {
    flex: 1 1 200px;
    background: #caf0f8;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }
  .stat-card h3 {
    margin-bottom: 0.5rem;
    color: #0077b6;
  }
  .stat-card p {
    font-size: 1.5rem;
    font-weight: 700;
    color: #03045e;
  }
  .dashboard-actions {
    text-align: center;
    margin-top: 2rem;
  }
  .dashboard-actions a {
    display: inline-block;
    margin: 0 0.5rem;
    padding: 0.6rem 1.2rem;
    background: #023e8a;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s;
  }
  .dashboard-actions a:hover {
    background: #03045e;
  }
</style>
@endpush

@section('content')
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h2>Bem‐vindo, {{ auth()->user()->name }}!</h2>
      <p>Aqui está um resumo rápido das suas tarefas</p>
    </div>

    <div class="stats">
      <div class="stat-card">
        <h3>Total de Tarefas</h3>
        <p>{{ auth()->user()->tasks()->count() }}</p>
      </div>
      <div class="stat-card">
        <h3>Pendentes</h3>
        <p>{{ auth()->user()->tasks()->where('status','pendente')->count() }}</p>
      </div>
      <div class="stat-card">
        <h3>Andamento</h3>
        <p>{{ auth()->user()->tasks()->where('status','andamento')->count() }}</p>
      </div>
      <div class="stat-card">
        <h3>Concluídas</h3>
        <p>{{ auth()->user()->tasks()->where('status','concluida')->count() }}</p>
      </div>
    </div>

    <div class="dashboard-actions">
      <a href="{{ route('tasks.index') }}">Ver Minhas Tarefas</a>
      <a href="{{ route('tasks.create') }}">Criar Nova Tarefa</a>
    </div>
  </div>
@endsection
