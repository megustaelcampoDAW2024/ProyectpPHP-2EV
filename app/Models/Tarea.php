<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'task';

    public static function getTareas()
    {
        $tareas = self::paginate(10);
        return $tareas;
    }
}