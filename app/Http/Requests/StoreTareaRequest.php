<?php
// filepath: /c:/xampp/htdocs/php2ev/app/Http/Requests/StoreTareaRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTareaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente' => 'required|exists:clientes,id',
            'descripcion' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'poblacion' => 'nullable|string|max:255',
            'codigo-post' => 'nullable|numeric',
            'provincia' => 'nullable|exists:provincias,id',
            'operario' => 'nullable|exists:users,id',
            'fecha-realizacion' => 'nullable|date',
            'estado' => 'required|in:B,P,R,C',
            'anotaciones-anteriores' => 'nullable|string',
            'anotaciones-posteriores' => 'nullable|string',
            'fich-resu' => 'nullable|file|mimes:pdf|max:2048',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}