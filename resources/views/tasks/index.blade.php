<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Tareas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tareas asignadas al usuario -->
            <h2 class="text-lg font-semibold mb-4">Tareas Asignadas a Ti</h2>
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">ID</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Estado</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr class="border border-gray-300 dark:border-gray-700">
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->id }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->name }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->description }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-black 
                                    {{ $task->status === 'waiting' ? 'bg-yellow-500' : '' }}
                                    {{ $task->status === 'in process' ? 'bg-blue-500' : '' }}
                                    {{ $task->status === 'completed' ? 'bg-green-500' : '' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-500 dark:text-yellow-400">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tareas de otros usuarios -->
            <h2 class="text-lg font-semibold mt-6 mb-4">Tareas de Otros Usuarios</h2>
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">ID</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasksFromOthers as $task)
                        <tr class="border border-gray-300 dark:border-gray-700">
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->id }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->name }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $task->description }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-black 
                                    {{ $task->status === 'waiting' ? 'bg-yellow-500' : '' }}
                                    {{ $task->status === 'in process' ? 'bg-blue-500' : '' }}
                                    {{ $task->status === 'completed' ? 'bg-green-500' : '' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if (auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('tasks.create') }}" class="mt-4 inline-block bg-blue-500 text-black px-4 py-2 rounded">
                    Crear Nueva Tarea
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
