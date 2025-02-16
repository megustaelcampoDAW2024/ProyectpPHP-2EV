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
        if(!$this->validateFecha($value)){
            $fail('La fecha de Realización debe completarse si la tarea ya se ha realizado');
        }
    }

    private function validateFecha($value)
    {
        if ($this->estado != 'R' && !empty($value)) {
            return false;
        } 
        if ($this->estado == 'R' && empty($value)) {
            return false;
        }
        return true;
    }

}
