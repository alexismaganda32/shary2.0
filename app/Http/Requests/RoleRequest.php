<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $name = 'required|max:50|unique:roles,name,0,status';
        if($this->id) {
            $name = 'required|max:50|unique:roles,name,'.$this->id.',id,status,1';
        }

        return [
            'name' => $name,
            'permissions' => 'required|array|min:1',
            'permissions.*.read' => 'required|not_in:undefined|digits_between:0,1',
            'permissions.*.create' => 'required|not_in:undefined|digits_between:0,1',
            'permissions.*.edit' => 'required|not_in:undefined|digits_between:0,1',
            'permissions.*.destroy' => 'required|not_in:undefined|digits_between:0,1',
            'permissions.*.module_id' => 'required|not_in:undefined|integer|exists:modules,id|distinct',
        ];
    }
}
