<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use softDeletes;
    protected $table = 'tareas';
    protected $guarded = [];

    public function operario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operario_id', 'id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }

    // Métodos get Datos

    public static function getAllTareas()
    {
        return Tarea::paginate(10);
    }

    public static function getTareasByOperario($user_id)
    {
        return Tarea::where('operario_id', $user_id)
            ->where('estado', '!=', 'R')
            ->paginate(10);
    }
}