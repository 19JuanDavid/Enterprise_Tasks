<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Tareas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 px-4 py-2">Proyecto_id</th>
                        <th class="border border-gray-300 px-4 py-2">Estado</th>
                        <th class="border border-gray-300 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2">{{ $task->id }}</td>
                            <td class="px-4 py-2">{{ $task->name }}</td>
                            <td class="px-4 py-2">{{ $task->description }}</td>
                            <td class="px-4 py-2">{{ $task->project_id }}</td>
                            <td class="px-4 py-2">{{ ucfirst($task->status) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-500">Ver</a> |
                                @if(Auth::user()->role === 'admin' || Auth::id() === $task->user_id)
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-500">Editar</a> |
                                @endif
                                @if(Auth::user()->role === 'admin')
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Eliminar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('tasks.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                    Crear Nueva Tarea
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
