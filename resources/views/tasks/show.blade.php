<x-layouts.app>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Detalhes da Tarefa</h1>

        <div class="bg-white p-6 rounded shadow max-w-md">
            <h2 class="text-xl font-semibold mb-2">{{ $task->titulo }}</h2>
            <p class="mb-4">{{ $task->descricao }}</p>
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>

            <a href="{{ route('tasks.index') }}" class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Voltar
            </a>
        </div>
    </div>
</x-layouts.app>
