<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Cliente;

class ValidCifTelefono implements Rule
{
    public function passes($attribute, $value)
    {
        $cif = request()->input('cif');
        $telefono = request()->input('telefono');

        return Cliente::where('cif', $cif)->where('telefono', $telefono)->exists();
    }

    public function message()
    {
        return 'El CIF y el teléfono no coinciden con ningún cliente.';
    }
}