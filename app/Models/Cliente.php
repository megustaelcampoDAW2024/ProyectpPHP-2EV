<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tarea;

class Cliente extends Model
{
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

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
