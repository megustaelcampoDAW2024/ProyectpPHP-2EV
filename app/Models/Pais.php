<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pais extends Model
{
    protected $table = 'paises';
    protected $guarded = [];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'pais_id', 'id');
    }

    public static function getPaises()
    {
        return Pais::all();
    }
}
