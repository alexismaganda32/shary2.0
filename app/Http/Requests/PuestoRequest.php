<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PuestoRequest extends FormRequest
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
        $name = 'required|max:191|unique:puestos,name,0,status';
        $keycode = 'required|integer|unique:puestos,keycode,0,status';
        if($this->id) {
            $keycode = 'required|integer|unique:puestos,keycode,'.$this->id.',id,status,1';
            $name = 'required|max:191|unique:puestos,name,'.$this->id.',id,status,1';
        }

        return [
            'name' => $name,
            'keycode' => $keycode
        ];
    }
}
