<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Proyectos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">ID</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nombre proyecto</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr class="border border-gray-300 dark:border-gray-700">
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $project->id }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $project->name }}</td>
                            <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $project->description }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('projects.show', $project) }}" class="text-blue-500">Ver</a> |
                                <a href="{{ route('projects.edit', $project) }}" class="text-yellow-500">Editar</a> |
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button >
            <a href="{{ route('projects.create') }}" class="mt-4 inline-block bg-blue-500 text-black px-4 py-2 rounded">
                Crear Nuevo Proyecto</a>
        </button>
        </div>
    </div>
</x-app-layout>
