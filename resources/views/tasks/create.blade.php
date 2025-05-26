@extends('layouts.app')

@section('title', 'Criar Nova Tarefa')

@section('content')
<div class="container" style="max-width: 600px; margin: 2rem auto;">

    <h1 style="color:#1F3A73; margin-bottom: 1rem;">Criar Nova Tarefa</h1>

    <form action="{{ route('tasks.store') }}" method="POST" style="background: #F4F6F9; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.12);">
        @csrf

        <label for="titulo" style="font-weight: 700; color:#2C3E50;">Título:</label><br>
        <input
            type="text"
            name="titulo"
            id="titulo"
            value="{{ old('titulo') }}"
            required
            style="width: 100%; padding: 0.6rem; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #4A90E2;"
        >
        @error('titulo')
            <div style="color: red; margin-bottom: 1rem;">{{ $message }}</div>
        @enderror

        <label for="descricao" style="font-weight: 700; color:#2C3E50;">Descrição:</label><br>
        <textarea
            name="descricao"
            id="descricao"
            rows="4"
            style="width: 100%; padding: 0.6rem; margin-bottom: 1rem; border-radius: 4px; border: 1px solid #4A90E2;"
        >{{ old('descricao') }}</textarea>
        @error('descricao')
            <div style="color: red; margin-bottom: 1rem;">{{ $message }}</div>
        @enderror

        <label for="status" style="font-weight: 700; color:#2C3E50;">Status:</label><br>
        <select
            name="status"
            id="status"
            required
            style="width: 100%; padding: 0.5rem; margin-bottom: 1.5rem; border-radius: 4px; border: 1px solid #4A90E2; color:#1F3A73; font-weight: 600;"
        >
            <option value="">Selecione o status</option>
            <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="andamento" {{ old('status') == 'andamento' ? 'selected' : '' }}>Em Andamento</option>
            <option value="concluida" {{ old('status') == 'concluida' ? 'selected' : '' }}>Concluída</option>
        </select>
        @error('status')
            <div style="color: red; margin-bottom: 1rem;">{{ $message }}</div>
        @enderror

        <button
            type="submit"
            style="background-color: #4A90E2; color: white; font-weight: 700; padding: 0.6rem 1.2rem; border: none; border-radius: 4px; cursor: pointer;"
        >
            Criar
        </button>

        <a href="{{ route('tasks.index') }}" style="margin-left: 1rem; color: #F39C12; font-weight: 700; text-decoration: none;">Cancelar</a>
    </form>

</div>
@endsection
