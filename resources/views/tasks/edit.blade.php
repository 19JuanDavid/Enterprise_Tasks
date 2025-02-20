<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="status">Estado:</label>
                <select name="status" id="status">
                    <option value="waiting" {{ $task->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                    <option value="in process" {{ $task->status == 'in process' ? 'selected' : '' }}>In Process</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            
                <button type="submit">Guardar cambios</button>
            </form>
            
        </div>
    </div>
</x-app-layout>
