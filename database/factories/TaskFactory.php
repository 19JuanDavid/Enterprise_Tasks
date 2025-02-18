<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       // Obtener una lista de IDs de administradores
       $adminUsers = User::where('role', 'admin')->pluck('id');

       // Crear un proyecto con un admin_id asignado
       $project = Project::factory()->create([
           'admin_id' => $adminUsers->random(),
       ]);

       // Obtener un usuario aleatorio para la tarea
       $user = User::inRandomOrder()->first();  // Asignar un usuario aleatorio

       return [
           'name' => $this->faker->sentence(4),
           'description' => $this->faker->paragraph(),
           'status' => $this->faker->randomElement(['waiting', 'in process', 'completed']),
           'project_id' => $project->id,  // Asegurarse de que se asigna el ID del proyecto
           'user_id' => $user->id,  // Asignar un usuario aleatorio
       ];
    }
}
