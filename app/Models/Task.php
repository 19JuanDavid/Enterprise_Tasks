<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'status', 
        'project_id', 
        'user_id'
    ];

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
