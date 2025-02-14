<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validFechaRealizacion implements ValidationRule
{

    protected $estado;

    public function __construct($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->estado != 'R' && $value != null) {
            $fail('La fecha de Realización solo puede ser introducida si la tarea ya se ha realizado.');
        } elseif ($this->estado == 'R' && $value == null) {
            $fail('La fecha de Realización es obligatoria si la tarea ya se ha realizado la tarea.');
        }
    }
}
