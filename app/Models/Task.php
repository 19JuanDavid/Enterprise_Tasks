<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relación con la tabla usuarios (una tarea pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
