<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Cliente;

class Cuota extends Model
{
    protected $table = 'cuota';
    protected $guarded = [];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function remesa(): BelongsTo
    {
        return $this->belongsTo(Remesa::class, 'remesa_id', 'id');
    }

    public static function getCuotasGroupedByCliente()
    {
        $cuotas = Cuota::all();
        $groupedCuotas = [];

        foreach ($cuotas as $cuota) {
            $groupedCuotas[$cuota->cliente_id][] = $cuota;
        }

        return $groupedCuotas;
    }

}
