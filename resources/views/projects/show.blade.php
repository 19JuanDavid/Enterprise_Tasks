<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Descripción</h3>
            <p class="mb-6">{{ $project->description }}</p>

            <h3 class="text-lg font-semibold mb-4">Tareas</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Nombre</th>
                        <th class="border border-gray-300 p-2">Usuario</th>
                        <th class="border border-gray-300 p-2">Estado</th>
                        <th class="border border-gray-300 p-2">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $task->id }}</td>
                            <td class="border border-gray-300 p-2">{{ $task->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $task->user->name }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $task->status }}</td>
                            <td class="border border-gray-300 p-2">{{ $task->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">No hay tareas para este proyecto.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
