@extends('layouts.app')

@section('title', 'Editar Tarefa')

@section('content')
<style>
    /* Container estilo caderno com cores modernas */
    .notebook-container {
        max-width: 600px;
        margin: 3rem auto;
        padding: 2.5rem 3.5rem;
        background: #f4f6f9; /* Cinza claro */
        border: 3px solid #1F3A73; /* Azul escuro */
        border-radius: 14px;
        box-shadow:
          8px 8px 20px rgba(31, 58, 115, 0.15),
          inset 0 0 18px #dce7f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        position: relative;
    }

    /* Linhas horizontais estilo caderno em azul suave */
    .notebook-container::before {
        content: '';
        position: absolute;
        top: 2rem;
        left: 3rem;
        right: 3rem;
        bottom: 2rem;
        background:
          repeating-linear-gradient(
            to bottom,
            transparent,
            transparent 22px,
            #4A90E2 23px /* azul claro linha */
          );
        z-index: 0;
        pointer-events: none;
        border-radius: 12px;
    }

    h2 {
        text-align: center;
        color: #1F3A73; /* Azul escuro */
        font-weight: 800;
        margin-bottom: 2.5rem;
        text-shadow: 1px 1px 1px #b8c6f0;
        position: relative;
        z-index: 2;
        letter-spacing: 1.2px;
    }

    form {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        gap: 1.8rem;
    }

    label {
        font-weight: 700;
        color: #2C3E50; /* Cinza escuro */
        margin-bottom: 0.4rem;
        font-size: 1.1rem;
        letter-spacing: 0.03em;
    }

    input[type="text"],
    textarea,
    select {
        padding: 0.85rem 1.2rem;
        border: 2px solid #4A90E2; /* azul claro */
        border-radius: 12px;
        font-size: 1.05rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fefefe;
        transition: border-color 0.35s ease, box-shadow 0.35s ease;
        box-shadow: inset 2px 2px 8px #d6e1fb;
        resize: vertical;
        color: #1F3A73;
    }

    input[type="text"]:focus,
    textarea:focus,
    select:focus {
        border-color: #F39C12; /* laranja vibrante */
        outline: none;
        box-shadow: 0 0 10px #f39c12aa;
        background-color: #fff;
        color: #2C3E50;
    }

    button {
        background: linear-gradient(45deg, #4A90E2, #1F3A73);
        color: white;
        font-weight: 800;
        padding: 1.15rem;
        border: none;
        border-radius: 16px;
        cursor: pointer;
        font-size: 1.15rem;
        box-shadow: 0 6px 0 #f39c12;
        transition: background 0.4s ease, transform 0.25s ease, box-shadow 0.25s ease;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    button:hover {
        background: linear-gradient(45deg, #f39c12, #d87e00);
        transform: translateY(-3px);
        box-shadow: 0 10px 12px #d87e0011;
    }

    /* Caixa de erros mais clean */
    .error-box {
        background: #fde7d9;
        color: #d35400;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        border: 1.5px solid #e67e22;
        font-weight: 700;
        list-style-type: disc;
        margin-bottom: 1.8rem;
    }
</style>

<div class="notebook-container">
    <h2>Editar Tarefa</h2>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="titulo">Título:</label>
        <input
            type="text"
            id="titulo"
            name="titulo"
            value="{{ old('titulo', $task->titulo) }}"
            required
            placeholder="Digite o título da tarefa"
        >

        <label for="descricao">Descrição:</label>
        <textarea
            id="descricao"
            name="descricao"
            rows="5"
            required
            placeholder="Descreva a tarefa"
        >{{ old('descricao', $task->descricao) }}</textarea>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="pendente" {{ old('status', $task->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="andamento" {{ old('status', $task->status) == 'andamento' ? 'selected' : '' }}>Em Andamento</option>
            <option value="concluida" {{ old('status', $task->status) == 'concluida' ? 'selected' : '' }}>Concluída</option>
        </select>

        <button type="submit">Salvar Alterações</button>
    </form>
</div>
@endsection
