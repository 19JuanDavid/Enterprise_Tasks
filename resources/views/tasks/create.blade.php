<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crear Nueva Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Descripción:</label>
                    <textarea id="description" name="description" class="w-full border border-gray-300 p-2 rounded" style="resize:none">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="project_id" class="block text-gray-700">Proyecto:</label>
                    <select id="project_id" name="project_id" class="w-full border border-gray-300 p-2 rounded">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700">Asignar a usuario:</label>
                    <input type="number" id="user_id" name="user_id" value="{{ old('user_id') }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
