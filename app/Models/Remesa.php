<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Remesa extends Model
{
    protected $table = 'remesa';
    protected $guarded = [];

    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class, 'remesa_id', 'id');
    }
}
