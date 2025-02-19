<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalles de la Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold">{{ $task->title }}</h3>
            <p class="mt-2">{{ $task->description }}</p>
        </div>
    </div>
</x-app-layout>
