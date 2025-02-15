<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tarea;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'clientes';
    protected $guarded = [];

    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'cliente_id', 'id');
    }

    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class, 'cliente_id', 'id');
    }

    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais_id', 'id');
    }

    public static function getClientes()
    {
        return Cliente::paginate(10);
    }
}
