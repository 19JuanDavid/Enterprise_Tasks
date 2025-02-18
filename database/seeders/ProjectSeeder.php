<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener una lista de IDs de administradores
        $adminUsers = User::where('role', 'admin')->pluck('id');

        if ($adminUsers->isEmpty()) {
            throw new \Exception("No hay administradores en la base de datos. Primero ejecuta UsersSeeder.");
        }

        // Crear 3 proyectos asignando un administrador aleatorio
        Project::factory(3)
            ->state([
                'admin_id' => $adminUsers->random(),  // Asignar un admin aleatorio
            ])
            ->create();
    }
}
