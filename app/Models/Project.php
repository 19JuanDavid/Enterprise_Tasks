<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    //

    protected $fillable = [
        'name', 
        'description', 
        'admin_id'
    ];


    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relación con la tabla tareas (un proyecto puede tener muchas tareas)
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

}
