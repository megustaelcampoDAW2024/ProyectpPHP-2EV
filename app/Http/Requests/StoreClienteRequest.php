<?php

namespace App\Http\Requests;

use App\Rules\validCifNieDni;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //arreglar CIF y TLF
        return [
            'pais_id' => 'required|exists:paises,id',
            'cif' => 'required|string|max:255',
            'nombre' => 'required', new validCifNieDni(),
            'telefono' => 'required', new ValidPhoneNumber(),
            'correo' => 'required|email|max:255',
            'cuenta_corriente' => 'required|string|max:255',
            'moneda' => 'required|string|exists:paises,iso_moneda',
            'importe_mensual' => 'required|numeric|min:0',
        ];
    }
}
