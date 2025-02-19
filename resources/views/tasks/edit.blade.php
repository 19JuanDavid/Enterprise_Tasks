<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Estado:</label>
                    <select id="status" name="status" class="w-full border border-gray-300 p-2 rounded">
                        <option value="waiting" {{ $task->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="in process" {{ $task->status == 'in process' ? 'selected' : '' }}>In Process</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar</button>
            </form>
        </div>
    </div>
</x-app-layout>
