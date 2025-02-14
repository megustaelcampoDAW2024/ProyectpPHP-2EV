<?php
// filepath: /c:/xampp/htdocs/php2ev/app/Http/Requests/StoreTareaRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidPhoneNumber;
use App\Rules\validCodigoPostal;
use App\Rules\ValidFechaRealizacion;

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
        // Mantener los ficheros al fallar la validación
        // Arreglar segunda validación de fecha
        return [
            'cliente_id' => 'not_in:0|required|exists:clientes,id',
            'nombre_contacto' => 'required|string|max:255',
            'apellido_contacto' => 'required|string|max:255',
            'correo_contacto' => 'required|email|max:255',
            'telefono_contacto' => ['required', 'string', 'max:50', new ValidPhoneNumber],
            'descripcion' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'poblacion' => 'nullable|string|max:255',
            'cod_postal' => ['nullable', 'numeric', 'digits:5', new validCodigoPostal($this->provincia_id)],
            'provincia_id' => 'nullable|exists:tbl_provincias,id',
            'operario_id' => 'nullable|exists:users,id',
            'fecha_realizacion' => ['nullable', 'date', new ValidFechaRealizacion($this->estado)],
            'estado' => 'required|in:B,P,R,C',
            'anotaciones_anteriores' => 'nullable|string',
            'anotaciones_posteriores' => 'nullable|string',
            'fichero' => 'nullable|file|mimes:pdf|max:2048',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}