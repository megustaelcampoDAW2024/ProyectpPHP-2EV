<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Define the pattern for a valid phone number
        $pattern = '/^\+\d{2}\d{9}$/';

        // Check if the value matches the pattern
        if (!preg_match($pattern, $value)) {
            $fail('The :attribute must have a valid format, containing only numbers and allowed separator characters.');
        }
    }
}
