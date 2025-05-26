<div>
    <label for="titulo" class="block font-semibold">Título:</label>
    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $task->titulo ?? '') }}"
        class="w-full border rounded p-2 @error('titulo') border-red-500 @enderror" required>
    @error('titulo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mt-4">
    <label for="descricao" class="block font-semibold">Descrição:</label>
    <textarea name="descricao" id="descricao"
        class="w-full border rounded p-2 @error('descricao') border-red-500 @enderror">{{ old('descricao', $task->descricao ?? '') }}</textarea>
    @error('descricao') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mt-4">
    <label for="status" class="block font-semibold">Status:</label>
    <select name="status" id="status"
        class="w-full border rounded p-2 @error('status') border-red-500 @enderror" required>
        <option value="pendente" {{ old('status', $task->status ?? '') == 'pendente' ? 'selected' : '' }}>Pendente</option>
        <option value="andamento" {{ old('status', $task->status ?? '') == 'andamento' ? 'selected' : '' }}>Em Andamento</option>
        <option value="concluida" {{ old('status', $task->status ?? '') == 'concluida' ? 'selected' : '' }}>Concluída</option>
    </select>
    @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>
