<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'country';
    protected $guarded = [];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'country_id', 'id');
    }
}
