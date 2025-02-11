<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Provincia extends Model
{
    protected $table = 'tbl_provincias';
    protected $guarded = [];

    public function tareas(): HasOne
    {
        return $this->hasOne(Tarea::class, 'provincia_id', 'id');
    }

    public function comunidad(): BelongsTo
    {
        return $this->belongsTo(Comunidad::class, 'comunidad_id', 'id');
    }
}
